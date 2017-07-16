<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\Fee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fee controller.
 *
 */
class FeeController extends Controller
{
    /**
     * Lists all fee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fees = $em->getRepository('BudgetBundle:Fee')->findAll();

        return $this->render('fee/index.html.twig', array(
            'fees' => $fees,
        ));
    }

    /**
     * Creates a new fee entity.
     *
     */
    public function newAction(Request $request)
    {
        $fee = new Fee();
        $form = $this->createForm('Budget\BudgetBundle\Form\FeeType', $fee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fee);
            $em->flush();

            return $this->redirectToRoute('fee_show', array('id' => $fee->getId()));
        }

        return $this->render('fee/new.html.twig', array(
            'fee' => $fee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fee entity.
     *
     */
    public function showAction(Fee $fee)
    {
        $deleteForm = $this->createDeleteForm($fee);

        return $this->render('fee/show.html.twig', array(
            'fee' => $fee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fee entity.
     *
     */
    public function editAction(Request $request, Fee $fee)
    {
        $deleteForm = $this->createDeleteForm($fee);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\FeeType', $fee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fee_edit', array('id' => $fee->getId()));
        }

        return $this->render('fee/edit.html.twig', array(
            'fee' => $fee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fee entity.
     *
     */
    public function deleteAction(Request $request, Fee $fee)
    {
        $form = $this->createDeleteForm($fee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fee);
            $em->flush();
        }

        return $this->redirectToRoute('fee_index');
    }

    /**
     * Creates a form to delete a fee entity.
     *
     * @param Fee $fee The fee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fee $fee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fee_delete', array('id' => $fee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
