<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\Goal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Goal controller.
 *
 */
class GoalController extends Controller
{
    /**
     * Lists all goal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $goals = $em->getRepository('BudgetBundle:Goal')->findAll();

        return $this->render('goal/index.html.twig', array(
            'goals' => $goals,
        ));
    }

    /**
     * Creates a new goal entity.
     *
     */
    public function newAction(Request $request)
    {
        $goal = new Goal();
        $form = $this->createForm('Budget\BudgetBundle\Form\GoalType', $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($goal);
            $em->flush();

            return $this->redirectToRoute('goal_show', array('id' => $goal->getId()));
        }

        return $this->render('goal/new.html.twig', array(
            'goal' => $goal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a goal entity.
     *
     */
    public function showAction(Goal $goal)
    {
        $deleteForm = $this->createDeleteForm($goal);

        return $this->render('goal/show.html.twig', array(
            'goal' => $goal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing goal entity.
     *
     */
    public function editAction(Request $request, Goal $goal)
    {
        $deleteForm = $this->createDeleteForm($goal);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\GoalType', $goal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goal_edit', array('id' => $goal->getId()));
        }

        return $this->render('goal/edit.html.twig', array(
            'goal' => $goal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a goal entity.
     *
     */
    public function deleteAction(Request $request, Goal $goal)
    {
        $form = $this->createDeleteForm($goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($goal);
            $em->flush();
        }

        return $this->redirectToRoute('goal_index');
    }

    /**
     * Creates a form to delete a goal entity.
     *
     * @param Goal $goal The goal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Goal $goal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('goal_delete', array('id' => $goal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
