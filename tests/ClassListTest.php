<?php

use PHPUnit\Framework\TestCase;

class ClassListTest extends TestCase
{

    public function setUp()
    {
        $this->classlist = new \Cajudev\Collections\ClassList();
    }

    public function test_classlist_add_get()
    {
        $this->classlist->add('col12', 'bold', 'mt-2');
        self::assertEquals('col12', $this->classlist->get(0));
    }

    public function test_classlist_add_remove()
    {
        $this->classlist->add('col12', 'bold', 'mt-2');
        $this->classlist->remove('col12', 'bold');
        self::assertEquals('mt-2', $this->classlist->get(0));
    }

    public function test_classlist_add_contains()
    {
        $this->classlist->add('col12', 'bold', 'mt-2');
        self::assertEquals(true, $this->classlist->contains('bold'));
    }

    public function test_classlist_add_reset()
    {
        $this->classlist->add('col12', 'bold', 'mt-2');
        $this->classlist->reset();
        self::assertEquals(false, $this->classlist->contains('bold'));
    }

    public function test_classlist_add_render()
    {
        $this->classlist->add('col12', 'bold', 'mt-2');
        self::assertEquals('class="col12 bold mt-2"', $this->classlist->render());
    }
}
