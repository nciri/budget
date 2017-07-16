<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\FeesCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feescategory controller.
 *
 */
class FeesCategoryController extends Controller
{
    /**
     * Lists all feesCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feesCategories = $em->getRepository('BudgetBundle:FeesCategory')->findAll();

        return $this->render('feescategory/index.html.twig', array(
            'feesCategories' => $feesCategories,
        ));
    }

    /**
     * Creates a new feesCategory entity.
     *
     */
    public function newAction(Request $request)
    {
        $feesCategory = new Feescategory();
        $form = $this->createForm('Budget\BudgetBundle\Form\FeesCategoryType', $feesCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feesCategory);
            $em->flush();

            return $this->redirectToRoute('feescategory_show', array('id' => $feesCategory->getId()));
        }

        return $this->render('feescategory/new.html.twig', array(
            'feesCategory' => $feesCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a feesCategory entity.
     *
     */
    public function showAction(FeesCategory $feesCategory)
    {
        $deleteForm = $this->createDeleteForm($feesCategory);

        return $this->render('feescategory/show.html.twig', array(
            'feesCategory' => $feesCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing feesCategory entity.
     *
     */
    public function editAction(Request $request, FeesCategory $feesCategory)
    {
        $deleteForm = $this->createDeleteForm($feesCategory);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\FeesCategoryType', $feesCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('feescategory_edit', array('id' => $feesCategory->getId()));
        }

        return $this->render('feescategory/edit.html.twig', array(
            'feesCategory' => $feesCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a feesCategory entity.
     *
     */
    public function deleteAction(Request $request, FeesCategory $feesCategory)
    {
        $form = $this->createDeleteForm($feesCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($feesCategory);
            $em->flush();
        }

        return $this->redirectToRoute('feescategory_index');
    }

    /**
     * Creates a form to delete a feesCategory entity.
     *
     * @param FeesCategory $feesCategory The feesCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FeesCategory $feesCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('feescategory_delete', array('id' => $feesCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
