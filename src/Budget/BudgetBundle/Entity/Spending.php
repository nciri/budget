<?php

namespace Budget\BudgetBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="Budget\BudgetBundle\Repository\SpendingRepository")
 */
class Spending
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
    private $spendingDate;

    /**
     * @var float
     */
    private $amount = '0';

    /**
     * @var \Budget\BudgetBundle\Entity\SpendingCategory
     */
    private $spendingCategory;


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
     * @return Spending
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
     * Set spendingDate
     *
     * @param \DateTime $spendingDate
     *
     * @return Spending
     */
    public function setSpendingDate($spendingDate)
    {
        $this->spendingDate = $spendingDate;

        return $this;
    }

    /**
     * Get spendingDate
     *
     * @return \DateTime
     */
    public function getSpendingDate()
    {
        return $this->spendingDate;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Spending
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
     * Set spendingCategory
     *
     * @param \Budget\BudgetBundle\Entity\SpendingCategory $spendingCategory
     *
     * @return Spending
     */
    public function setSpendingCategory(\Budget\BudgetBundle\Entity\SpendingCategory $spendingCategory = null)
    {
        $this->spendingCategory = $spendingCategory;

        return $this;
    }

    /**
     * Get spendingCategory
     *
     * @return \Budget\BudgetBundle\Entity\SpendingCategory
     */
    public function getSpendingCategory()
    {
        return $this->spendingCategory;
    }
}
