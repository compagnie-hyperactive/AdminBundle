<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 02/05/2017
 * Time: 15:39
 */

namespace Lch\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BreadcrumbItem
 *
 * Entity used to generate breadcrumbs (used in collections)
 *
 * @ORM\Table(name="breadcrumb_item")
 * @ORM\Entity(repositoryClass="")
 */
class BreadcrumbItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string $link the link to another page if resource item is contained elsewhere
     * @ORM\Column(type="string", nullable=true)
     */
    protected $link;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

}