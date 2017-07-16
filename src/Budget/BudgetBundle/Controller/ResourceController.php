<?php

namespace Budget\BudgetBundle\Controller;

use Budget\BudgetBundle\Entity\Resource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Resource controller.
 *
 */
class ResourceController extends Controller
{
    /**
     * Lists all resource entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resources = $em->getRepository('BudgetBundle:Resource')->findAll();

        return $this->render('resource/index.html.twig', array(
            'resources' => $resources,
        ));
    }

    /**
     * Creates a new resource entity.
     *
     */
    public function newAction(Request $request)
    {
        $resource = new Resource();
        $form = $this->createForm('Budget\BudgetBundle\Form\ResourceType', $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resource);
            $em->flush();

            return $this->redirectToRoute('resource_show', array('id' => $resource->getId()));
        }

        return $this->render('resource/new.html.twig', array(
            'resource' => $resource,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a resource entity.
     *
     */
    public function showAction(Resource $resource)
    {
        $deleteForm = $this->createDeleteForm($resource);

        return $this->render('resource/show.html.twig', array(
            'resource' => $resource,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing resource entity.
     *
     */
    public function editAction(Request $request, Resource $resource)
    {
        $deleteForm = $this->createDeleteForm($resource);
        $editForm = $this->createForm('Budget\BudgetBundle\Form\ResourceType', $resource);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resource_edit', array('id' => $resource->getId()));
        }

        return $this->render('resource/edit.html.twig', array(
            'resource' => $resource,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a resource entity.
     *
     */
    public function deleteAction(Request $request, Resource $resource)
    {
        $form = $this->createDeleteForm($resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resource);
            $em->flush();
        }

        return $this->redirectToRoute('resource_index');
    }

    /**
     * Creates a form to delete a resource entity.
     *
     * @param Resource $resource The resource entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Resource $resource)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resource_delete', array('id' => $resource->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
