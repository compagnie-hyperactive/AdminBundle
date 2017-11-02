<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 01/11/17
 * Time: 16:32
 */

namespace Lch\AdminBundle\Tests\Behaviour;

use LCH\AdminBundle\Behaviour\Breadcrumbable;

class BreadcrumbableTest extends \PHPUnit_Framework_TestCase
{
    // TODO Find a way to test the Breadcrumbable trait
    public function testGetBreadcrumbItems()
    {
        $mock = $this->getMockForTrait('breadcrumbable');

        $mock->expects($this->any())
        ->method('abstractMethod')
        ->will($this->returnValue(TRUE));

        $this->assertTrue($mock->getBreadcrumbItems());
    }
}