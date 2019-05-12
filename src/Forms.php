<?php

namespace Cajudev;

use Cajudev\EasyForm\EasyForm;
use Cajudev\Elements\Form;
use Cajudev\Elements\Input;
use Cajudev\Elements\TextArea;
use Cajudev\Elements\Label;
use Cajudev\Elements\FieldSet;
use Cajudev\Elements\Legend;
use Cajudev\Elements\Select;
use Cajudev\Elements\OptGroup;
use Cajudev\Elements\Option;
use Cajudev\Elements\Button;
use Cajudev\Elements\DataList;
use Cajudev\Elements\OutPut;
use Cajudev\Elements\Small;
use Cajudev\Elements\Text;

class Forms
{
    public static function create(string $name = null)
    {
        switch (strtolower($name)) {
            case null:
            case 'form':     return new Form();
            case 'input':    return new Input();
            case 'textarea': return new TextArea();
            case 'label':    return new Label();
            case 'fieldset': return new FieldSet();
            case 'legend':   return new Legend();
            case 'select':   return new Select();
            case 'optgroup': return new OptGroup();
            case 'option':   return new Option();
            case 'button':   return new Button();
            case 'dataList': return new DataList();
            case 'output':   return new OutPut();
            case 'small':    return new Small();
            case 'text':     return new Text();
            case 'easyform': return new EasyForm();
        }
    }
}
