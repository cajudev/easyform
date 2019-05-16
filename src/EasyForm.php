<?php

namespace Cajudev;

use Cajudev\Elements\Form;
use Cajudev\Util\Character;
use Cajudev\Collections\TemplateStore;
use Cajudev\Collections\RecursiveWalker;

class EasyForm
{
    private $form;
    private $templates;

    public function __construct(array $params = [])
    {
        $this->form = new Form();

        foreach ($params as $key => $value) {
            $this->form->attrlist->add($key, $value);
        }

        $this->templates = new TemplateStore();
    }

    public function create(string $name, array $params = [])
    {
        if (!$this->templates->get($name)) {
            throw new \InvalidArgumentException("Template '{$name}' not found");
        }

       $template = $this->templates->get($name);
       $this->setTemplateVariables($template, $params);
       $this->build($this->form, $template);
    }

    public function setTemplateVariables(&$template, $params)
    {
        RecursiveWalker::walk($template, function(&$array, $key) use ($params) {
            if (!preg_match_all('/(?<tag>::\w+)(?<cond>[!?])?/', $array[$key], $matches, PREG_SET_ORDER)) {
                return;
            }

            foreach ($matches as $match) {

                if (isset($match['cond']) && $match['cond'] === '!') {
                    $array[$key] = isset($params[$match['tag']]);
                    continue;
                }
    
                if (!empty($params[$match['tag']])) {
                    $replace = $params[$match['tag']];
                    $array[$key] = is_string($replace) 
                                 ? str_replace($match['tag'].$match['cond'], $replace, $array[$key]) 
                                 : $replace;
                    continue;
                }
    
                if (isset($match['cond']) && $match['cond'] === '?') {
                    $array[$key] = str_replace($match['tag'], '', $array[$key]);
                    continue;
                }
    
                unset($array[$key]);
            }
        });
    }

    private function build($element, $template)
    {
        foreach ($template as $key => $value) {

            if (isset($value['display']) && !$value['display']) {
                continue;
            }

            $child = $element->create($key);

            if (isset($value['attributes'])) {
                foreach ($value['attributes'] as $k => $v) {
                    $child->attrlist->add($k, $v);
                }
            }

            if (isset($value['options']) && is_array($value['options'])) {
                foreach ($value['options'] as $value => $description) {
                    $child->create('option')->attrlist->add('value', $value)->parent()
                          ->create('text')->textContent($description);
                }
            }

            if (isset($value['text'])) {
                $child->create('text')->textContent($value['text']);
            }
            
            if (isset($value['children'])) {
                $this->build($child, $value['children']);
            }
        }
    }

    public function breakLine(int $marginY = 10)
    {
        $this->form->create('div')->attrlist->add('style', "flex: 0 0 100%; max-width: 100%; margin: {$marginY}px 0");
    }

    public function drawLine($marginY = 10, $width = 100, $color = '#DADADA', $position = 'none')
    {
        $this->form->create('div')->attrlist->add('style', "flex: 0 0 100%; max-width: 100%; margin: {$marginY}px 0")->parent()
            ->create('hr')->attrlist->add('width', $width.'%')->add('style', "border-color: {$color}; float: {$position};");
    }

    public function getForm()
    {
        return $this->form;
    }

    public function __get($property)
    {
        if ($property === 'templates') {
            return $this->templates;
        }
    }

    public function render()
    {
        return $this->form->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
