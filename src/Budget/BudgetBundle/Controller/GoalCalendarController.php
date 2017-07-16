<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\GoalCalendar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Goalcalendar controller.
 *
 */
class GoalCalendarController extends Controller
{
    /**
     * Lists all goalCalendar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $goalCalendars = $em->getRepository('BudgetBundle:GoalCalendar')->findAll();

        return $this->render('goalcalendar/index.html.twig', array(
            'goalCalendars' => $goalCalendars,
        ));
    }

    /**
     * Creates a new goalCalendar entity.
     *
     */
    public function newAction(Request $request)
    {
        $goalCalendar = new Goalcalendar();
        $form = $this->createForm('Budget\BudgetBundle\Form\GoalCalendarType', $goalCalendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($goalCalendar);
            $em->flush();

            return $this->redirectToRoute('goalcalendar_show', array('id' => $goalCalendar->getId()));
        }

        return $this->render('goalcalendar/new.html.twig', array(
            'goalCalendar' => $goalCalendar,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a goalCalendar entity.
     *
     */
    public function showAction(GoalCalendar $goalCalendar)
    {
        $deleteForm = $this->createDeleteForm($goalCalendar);

        return $this->render('goalcalendar/show.html.twig', array(
            'goalCalendar' => $goalCalendar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing goalCalendar entity.
     *
     */
    public function editAction(Request $request, GoalCalendar $goalCalendar)
    {
        $deleteForm = $this->createDeleteForm($goalCalendar);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\GoalCalendarType', $goalCalendar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goalcalendar_edit', array('id' => $goalCalendar->getId()));
        }

        return $this->render('goalcalendar/edit.html.twig', array(
            'goalCalendar' => $goalCalendar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a goalCalendar entity.
     *
     */
    public function deleteAction(Request $request, GoalCalendar $goalCalendar)
    {
        $form = $this->createDeleteForm($goalCalendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($goalCalendar);
            $em->flush();
        }

        return $this->redirectToRoute('goalcalendar_index');
    }

    /**
     * Creates a form to delete a goalCalendar entity.
     *
     * @param GoalCalendar $goalCalendar The goalCalendar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GoalCalendar $goalCalendar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('goalcalendar_delete', array('id' => $goalCalendar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
