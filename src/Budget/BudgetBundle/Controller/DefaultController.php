<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\Fee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BudgetBundle:Default:index.html.twig');
    }
}
