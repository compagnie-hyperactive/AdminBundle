<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 02/05/2017
 * Time: 17:11
 */

namespace Lch\AdminBundle\Behaviour;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Allow an entity to have a list of breadcrumb items to manage a simple breadcrumb on it
 *
 * Class Breadcrumbable
 * @package Lch\AdminBundle\Behaviour
 */
trait Breadcrumbable
{
    /**
     * @var ArrayCollection[BreadcrumbItem]
     * @ORM\ManyToMany(targetEntity="Lch\AdminBundle\Entity\BreadcrumbItem", cascade={"all"})
     */
    private $breadcrumbItems;


    /**
     * @return ArrayCollection
     */
    public function getBreadcrumbItems()
    {
        return $this->breadcrumbItems;
    }

    /**
     * @param ArrayCollection $breadcrumbItems
     */
    public function setBreadcrumbItems($breadcrumbItems)
    {
        $this->breadcrumbItems = $breadcrumbItems;
    }

}