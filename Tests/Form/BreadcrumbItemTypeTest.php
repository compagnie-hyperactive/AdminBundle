<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 01/11/17
 * Time: 17:26
 */

namespace Lch\AdminBundle\Tests\Form;

use Lch\AdminBundle\Entity\BreadcrumbItem;
use Lch\AdminBundle\Form\BreadcrumbItemType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BreadcrumbItemTypeTest extends TypeTestCase
{
    private $validator;

    public function testSubmitValidData()
    {
        $data = $this->getBreadcrumbItem();
        $data->setName('Name');
        $data->setLink('Link');

        $form = $this->factory->create(BreadcrumbItemType::class);

        $form->submit($data);

        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isValid());

        //$this->assertEquals($data, $form->getData());

//        $view = $form->createView();
//
        $this->assertTrue($form->isSynchronized(), 'BreadcrumbItemType is not synchronized');
//        $this->assertEquals($data, $form->getData());
//
//        $view = $form->createView();
//        $children = $view->children;

//        foreach (array_keys($formData) as $key) {
//            $this->assertArrayHasKey($key, $children);
//        }
    }

    protected function getExtensions()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        // use getMock() on PHPUnit 5.3 or below
        // $this->validator = $this->getMock(ValidatorInterface::class);
        $this->validator
            ->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()));
        $this->validator
            ->method('getMetadataFor')
            ->will($this->returnValue(new ClassMetadata(Form::class)));

        return array(
            new ValidatorExtension($this->validator),
        );
    }

    /**
     * @return BreadcrumbItem
     */
    protected function getBreadcrumbItem()
    {
        return $this->getMockForAbstractClass('Lch\AdminBundle\Entity\BreadcrumbItem');
    }
}