<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\IssueStatus;
use AppBundle\Form\IssueStatusType;

/**
 * IssueStatus controller.
 *
 */
class IssueStatusController extends Controller
{

    /**
     * Lists all IssueStatus entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:IssueStatus')->findAll();

        return $this->render('AppBundle:IssueStatus:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new IssueStatus entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new IssueStatus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('issuestatus_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:IssueStatus:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a IssueStatus entity.
     *
     * @param IssueStatus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(IssueStatus $entity)
    {
        $form = $this->createForm(new IssueStatusType(), $entity, array(
            'action' => $this->generateUrl('issuestatus_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new IssueStatus entity.
     *
     */
    public function newAction()
    {
        $entity = new IssueStatus();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:IssueStatus:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a IssueStatus entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IssueStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IssueStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:IssueStatus:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing IssueStatus entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IssueStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IssueStatus entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:IssueStatus:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a IssueStatus entity.
    *
    * @param IssueStatus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(IssueStatus $entity)
    {
        $form = $this->createForm(new IssueStatusType(), $entity, array(
            'action' => $this->generateUrl('issuestatus_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing IssueStatus entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IssueStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IssueStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('issuestatus_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:IssueStatus:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a IssueStatus entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:IssueStatus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find IssueStatus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('issuestatus'));
    }

    /**
     * Creates a form to delete a IssueStatus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issuestatus_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
