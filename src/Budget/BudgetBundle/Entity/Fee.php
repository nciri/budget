<?php

namespace Budget\BudgetBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="Budget\BudgetBundle\Repository\FeeRepository")
 */
class Fee
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
    private $feeDate;

    /**
     * @var float
     */
    private $amount = '0';

    /**
     * @var \Budget\BudgetBundle\Entity\FeesCategory
     */
    private $feesCategory;


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
     * @return Fee
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
     * Set feeDate
     *
     * @param \DateTime $feeDate
     *
     * @return Fee
     */
    public function setFeeDate($feeDate)
    {
        $this->feeDate = $feeDate;

        return $this;
    }

    /**
     * Get feeDate
     *
     * @return \DateTime
     */
    public function getFeeDate()
    {
        return $this->feeDate;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Fee
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
     * Set feesCategory
     *
     * @param \Budget\BudgetBundle\Entity\FeesCategory $feesCategory
     *
     * @return Fee
     */
    public function setFeesCategory(\Budget\BudgetBundle\Entity\FeesCategory $feesCategory = null)
    {
        $this->feesCategory = $feesCategory;

        return $this;
    }

    /**
     * Get feesCategory
     *
     * @return \Budget\BudgetBundle\Entity\FeesCategory
     */
    public function getFeesCategory()
    {
        return $this->feesCategory;
    }
}
