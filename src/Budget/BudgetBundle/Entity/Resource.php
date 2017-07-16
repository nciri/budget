<?php

namespace Budget\BudgetBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="Budget\BudgetBundle\Repository\ResourceRepository")
 */
class Resource
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $resourceDate;

    /**
     * @var float
     */
    private $amount = '0';

    /**
     * @var \Budget\BudgetBundle\Entity\ResourceCategory
     */
    private $resourceCategory;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Resource
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set resourceDate
     *
     * @param \DateTime $resourceDate
     *
     * @return Resource
     */
    public function setResourceDate($resourceDate)
    {
        $this->resourceDate = $resourceDate;

        return $this;
    }

    /**
     * Get resourceDate
     *
     * @return \DateTime
     */
    public function getResourceDate()
    {
        return $this->resourceDate;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Resource
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set resourceCategory
     *
     * @param \Budget\BudgetBundle\Entity\ResourceCategory $resourceCategory
     *
     * @return Resource
     */
    public function setResourceCategory(\Budget\BudgetBundle\Entity\ResourceCategory $resourceCategory = null)
    {
        $this->resourceCategory = $resourceCategory;

        return $this;
    }

    /**
     * Get resourceCategory
     *
     * @return \Budget\BudgetBundle\Entity\ResourceCategory
     */
    public function getResourceCategory()
    {
        return $this->resourceCategory;
    }
}
