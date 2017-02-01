<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/05/15
 * Time: 16:01
 */
namespace Lch\AdminBundle\Event;

use Knp\Component\Pager\Pagination\PaginationInterface;

class RenderPreHeaderEvent extends ListEvent
{

    /**
     * @var PaginationInterface The list records
     */
    private $records;

    /**
     * @var string the HTML output to display before list
     */
    private $output;

    /**
     * @param PaginationInterface $records
     * @param array $options
     */
    public function __construct(PaginationInterface $records, array $options)
    {
        parent::__construct($options);
        $this->records = $records;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param string $output
     * @return RenderPreHeaderEvent
     */
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @return PaginationInterface
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * @param PaginationInterface $records
     * @return RenderListEvent
     */
    public function setRecords($records)
    {
        $this->records = $records;
        return $this;
    }

    /**
     * @param $output string HTML fragment to display
     * @return $this
     */
    public function addOutput($output) {
        $this->output .= $output;
        return $this;
    }
}