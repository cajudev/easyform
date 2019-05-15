<?php

namespace Cajudev;

use Cajudev\Elements\Form;
use Cajudev\Collections\TemplateStore;

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
            throw new \InvalidArgumentException('Template not found');
        }

        $template = $this->templates->get($name);
        array_walk_recursive($template, function(&$value) use ($params){
            if (preg_match('/(?<tag>::\w+)/', $value, $match)) {
                $replace = $params[$match['tag']] ?? '';
                $value = str_replace($match['tag'], $replace, $value);
            }
        });  
       $this->build($this->form, $template, $params);
    }

    private function build($element, $template)
    {
        foreach ($template as $key => $value) {
            $child = $element->create($key);

            if (isset($value['attributes'])) {
                foreach ($value['attributes'] as $k => $v) {
                    $child->attrlist->add($k, $v);
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
