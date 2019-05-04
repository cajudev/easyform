<?php

use PHPUnit\Framework\TestCase;

class AttrListTest extends TestCase
{

    public function setUp()
    {
        $this->attrlist = new \Cajudev\Collections\AttrList();
    }

    public function test_attrlist_add_get()
    {
        $this->attrlist->add('href', 'http://www.google.com');
        self::assertEquals('http://www.google.com', $this->attrlist->get('href'));
    }

    public function test_attrlist_add_remove()
    {
        $this->attrlist->add('href', 'http://www.google.com')
                       ->remove('href');
        self::assertEquals(null, $this->attrlist->get('href'));
    }

    public function test_attrlist_add_reset()
    {
        $this->attrlist->add('href', 'http://www.google.com')
                       ->reset();
        self::assertEquals(null, $this->attrlist->get('href'));
    }

    public function test_attrlist_add_render()
    {
        $this->attrlist->add('href', 'http://www.google.com')
                       ->add('alt', 'google')
                       ->add('height', '42');

        self::assertEquals(
            'href="http://www.google.com" alt="google" height="42"',
            $this->attrlist->render()
        );
    }
}
