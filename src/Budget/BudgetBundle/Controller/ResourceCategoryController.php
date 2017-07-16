<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\ResourceCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Resourcecategory controller.
 *
 */
class ResourceCategoryController extends Controller
{
    /**
     * Lists all resourceCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resourceCategories = $em->getRepository('BudgetBundle:ResourceCategory')->findAll();

        return $this->render('resourcecategory/index.html.twig', array(
            'resourceCategories' => $resourceCategories,
        ));
    }

    /**
     * Creates a new resourceCategory entity.
     *
     */
    public function newAction(Request $request)
    {
        $resourceCategory = new Resourcecategory();
        $form = $this->createForm('Budget\BudgetBundle\Form\ResourceCategoryType', $resourceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resourceCategory);
            $em->flush();

            return $this->redirectToRoute('resourcecategory_show', array('id' => $resourceCategory->getId()));
        }

        return $this->render('resourcecategory/new.html.twig', array(
            'resourceCategory' => $resourceCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a resourceCategory entity.
     *
     */
    public function showAction(ResourceCategory $resourceCategory)
    {
        $deleteForm = $this->createDeleteForm($resourceCategory);

        return $this->render('resourcecategory/show.html.twig', array(
            'resourceCategory' => $resourceCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing resourceCategory entity.
     *
     */
    public function editAction(Request $request, ResourceCategory $resourceCategory)
    {
        $deleteForm = $this->createDeleteForm($resourceCategory);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\ResourceCategoryType', $resourceCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resourcecategory_edit', array('id' => $resourceCategory->getId()));
        }

        return $this->render('resourcecategory/edit.html.twig', array(
            'resourceCategory' => $resourceCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a resourceCategory entity.
     *
     */
    public function deleteAction(Request $request, ResourceCategory $resourceCategory)
    {
        $form = $this->createDeleteForm($resourceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resourceCategory);
            $em->flush();
        }

        return $this->redirectToRoute('resourcecategory_index');
    }

    /**
     * Creates a form to delete a resourceCategory entity.
     *
     * @param ResourceCategory $resourceCategory The resourceCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ResourceCategory $resourceCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resourcecategory_delete', array('id' => $resourceCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
