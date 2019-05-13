<?php

namespace Cajudev;

use Cajudev\Elements\Form;

class EasyForm
{
    private $form;
    private $templates;

    public function __construct(array $params = [])
    {
        $this->form = new Form();

        if (isset($params['id'])) {
            $this->form->attrlist->add('id', $params['id']);
        }
        
        if (isset($params['action'])) {
            $this->form->attrlist->add('action', $params['action']);
        }

        if (isset($params['class'])) {
            $this->form->classlist->add($params['class']);
        }
    }

    public function createTemplate(string $name, array $template)
    {
       $this->templates[$name] = $template;
    }

    public function create(string $name, array $params = [])
    {
        if (empty($this->templates[$name])) {
            throw new \InvalidArgumentException('Template not found');
        }

        $template = $this->templates[$name];
        array_walk_recursive($template, function(&$value) use ($params){
            if (isset($params[$value])) {
                $value = $params[$value];
            }
        });    
       $this->build($this->form, $template, $params);
    }

    private function build($element, $template)
    {
        foreach ($template as $key => $value) {
            $child = $element->create($key);

            if (isset($value['class'])) {
                $child->classlist->add($value['class']);
            }

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

    public function render()
    {
        return $this->form->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
