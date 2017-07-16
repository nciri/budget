<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\SpendingCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Spendingcategory controller.
 *
 */
class SpendingCategoryController extends Controller
{
    /**
     * Lists all spendingCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $spendingCategories = $em->getRepository('BudgetBundle:SpendingCategory')->findAll();

        return $this->render('spendingcategory/index.html.twig', array(
            'spendingCategories' => $spendingCategories,
        ));
    }

    /**
     * Creates a new spendingCategory entity.
     *
     */
    public function newAction(Request $request)
    {
        $spendingCategory = new Spendingcategory();
        $form = $this->createForm('Budget\BudgetBundle\Form\SpendingCategoryType', $spendingCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($spendingCategory);
            $em->flush();

            return $this->redirectToRoute('spendingcategory_show', array('id' => $spendingCategory->getId()));
        }

        return $this->render('spendingcategory/new.html.twig', array(
            'spendingCategory' => $spendingCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a spendingCategory entity.
     *
     */
    public function showAction(SpendingCategory $spendingCategory)
    {
        $deleteForm = $this->createDeleteForm($spendingCategory);

        return $this->render('spendingcategory/show.html.twig', array(
            'spendingCategory' => $spendingCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing spendingCategory entity.
     *
     */
    public function editAction(Request $request, SpendingCategory $spendingCategory)
    {
        $deleteForm = $this->createDeleteForm($spendingCategory);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\SpendingCategoryType', $spendingCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spendingcategory_edit', array('id' => $spendingCategory->getId()));
        }

        return $this->render('spendingcategory/edit.html.twig', array(
            'spendingCategory' => $spendingCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a spendingCategory entity.
     *
     */
    public function deleteAction(Request $request, SpendingCategory $spendingCategory)
    {
        $form = $this->createDeleteForm($spendingCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($spendingCategory);
            $em->flush();
        }

        return $this->redirectToRoute('spendingcategory_index');
    }

    /**
     * Creates a form to delete a spendingCategory entity.
     *
     * @param SpendingCategory $spendingCategory The spendingCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SpendingCategory $spendingCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('spendingcategory_delete', array('id' => $spendingCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
