<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 01/11/17
 * Time: 17:05
 */

namespace Lch\AdminBundle\Tests\Form;

use Lch\AdminBundle\Form\UnarchiveType;
use Symfony\Component\Form\Test\TypeTestCase;

class UnarchiveTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $form = $this->factory->create(UnarchiveType::class);

        $form->submit([]);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();

        // Id as to be "Unrchive"
        $this->assertEquals($view->vars['id'], 'unarchive');

        // Only one element is expected
        $this->assertEquals(count($view->children), 1);

        // Expected Element should be named Submit
        $this->assertTrue(isset($view->children['submit']));
    }
}