<?php

namespace Budget\BudgetBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="Budget\BudgetBundle\Repository\GoalCalendarRepository")
 */
class GoalCalendar
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $milestoneDate;

    /**
     * @var float
     */
    private $milestoneAmount = '0';

    /**
     * @var float
     */
    private $milestoneDue = '0';

    /**
     * @var \Budget\BudgetBundle\Entity\Goal
     */
    private $goal;


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
     * Set milestoneDate
     *
     * @param \DateTime $milestoneDate
     *
     * @return GoalCalendar
     */
    public function setMilestoneDate($milestoneDate)
    {
        $this->milestoneDate = $milestoneDate;

        return $this;
    }

    /**
     * Get milestoneDate
     *
     * @return \DateTime
     */
    public function getMilestoneDate()
    {
        return $this->milestoneDate;
    }

    /**
     * Set milestoneAmount
     *
     * @param float $milestoneAmount
     *
     * @return GoalCalendar
     */
    public function setMilestoneAmount($milestoneAmount)
    {
        $this->milestoneAmount = $milestoneAmount;

        return $this;
    }

    /**
     * Get milestoneAmount
     *
     * @return float
     */
    public function getMilestoneAmount()
    {
        return $this->milestoneAmount;
    }

    /**
     * Set milestoneDue
     *
     * @param float $milestoneDue
     *
     * @return GoalCalendar
     */
    public function setMilestoneDue($milestoneDue)
    {
        $this->milestoneDue = $milestoneDue;

        return $this;
    }

    /**
     * Get milestoneDue
     *
     * @return float
     */
    public function getMilestoneDue()
    {
        return $this->milestoneDue;
    }

    /**
     * Set goal
     *
     * @param \Budget\BudgetBundle\Entity\Goal $goal
     *
     * @return GoalCalendar
     */
    public function setGoal(\Budget\BudgetBundle\Entity\Goal $goal = null)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return \Budget\BudgetBundle\Entity\Goal
     */
    public function getGoal()
    {
        return $this->goal;
    }
}
