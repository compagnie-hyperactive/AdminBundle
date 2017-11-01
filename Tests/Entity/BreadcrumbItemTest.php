<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 01/11/17
 * Time: 16:19
 */

namespace Lch\AdminBundle\Tests\Entity;


use Lch\AdminBundle\Entity\BreadcrumbItem;

class BreadcrumbItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGetId()
    {
        $breadcrumbItem = $this->getBreadcrumbItem();
        $this->assertNull($breadcrumbItem->getId());
    }

    public function testName()
    {
        $breadcrumbItem = $this->getBreadcrumbItem();
        $this->assertNull($breadcrumbItem->getName());

        $name = 'Test Name';
        $breadcrumbItem->setName($name);
        $this->assertEquals($name, $breadcrumbItem->getName());
    }

    public function testLink()
    {
        $breadcrumbItem = $this->getBreadcrumbItem();
        $this->assertNull($breadcrumbItem->getLink());

        $link = 'Test Name';
        $breadcrumbItem->setLink($link);
        $this->assertEquals($link, $breadcrumbItem->getLink());
    }

    /**
     * @return BreadcrumbItem
     */
    protected function getBreadcrumbItem()
    {
        return $this->getMockForAbstractClass('Lch\AdminBundle\Entity\BreadcrumbItem');
    }
}