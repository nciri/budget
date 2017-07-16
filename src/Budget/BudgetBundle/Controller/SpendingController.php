<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\Spending;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Spending controller.
 *
 */
class SpendingController extends Controller
{
    /**
     * Lists all spending entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $spendings = $em->getRepository('BudgetBundle:Spending')->findAll();

        return $this->render('spending/index.html.twig', array(
            'spendings' => $spendings,
        ));
    }

    /**
     * Creates a new spending entity.
     *
     */
    public function newAction(Request $request)
    {
        $spending = new Spending();
        $form = $this->createForm('Budget\BudgetBundle\Form\SpendingType', $spending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($spending);
            $em->flush();

            return $this->redirectToRoute('spending_show', array('id' => $spending->getId()));
        }

        return $this->render('spending/new.html.twig', array(
            'spending' => $spending,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a spending entity.
     *
     */
    public function showAction(Spending $spending)
    {
        $deleteForm = $this->createDeleteForm($spending);

        return $this->render('spending/show.html.twig', array(
            'spending' => $spending,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing spending entity.
     *
     */
    public function editAction(Request $request, Spending $spending)
    {
        $deleteForm = $this->createDeleteForm($spending);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\SpendingType', $spending);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spending_edit', array('id' => $spending->getId()));
        }

        return $this->render('spending/edit.html.twig', array(
            'spending' => $spending,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a spending entity.
     *
     */
    public function deleteAction(Request $request, Spending $spending)
    {
        $form = $this->createDeleteForm($spending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($spending);
            $em->flush();
        }

        return $this->redirectToRoute('spending_index');
    }

    /**
     * Creates a form to delete a spending entity.
     *
     * @param Spending $spending The spending entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Spending $spending)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('spending_delete', array('id' => $spending->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
