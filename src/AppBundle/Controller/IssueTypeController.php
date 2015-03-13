<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\IssueType;
use AppBundle\Form\IssueTypeType;

/**
 * IssueType controller.
 *
 */
class IssueTypeController extends Controller
{

    /**
     * Lists all IssueType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:IssueType')->findAll();

        return $this->render('AppBundle:IssueType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new IssueType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new IssueType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('issuetype_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:IssueType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a IssueType entity.
     *
     * @param IssueType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(IssueType $entity)
    {
        $form = $this->createForm(new IssueTypeType(), $entity, array(
            'action' => $this->generateUrl('issuetype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new IssueType entity.
     *
     */
    public function newAction()
    {
        $entity = new IssueType();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:IssueType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a IssueType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IssueType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IssueType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:IssueType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing IssueType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IssueType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IssueType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:IssueType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a IssueType entity.
    *
    * @param IssueType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(IssueType $entity)
    {
        $form = $this->createForm(new IssueTypeType(), $entity, array(
            'action' => $this->generateUrl('issuetype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing IssueType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:IssueType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IssueType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('issuetype_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:IssueType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a IssueType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:IssueType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find IssueType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('issuetype'));
    }

    /**
     * Creates a form to delete a IssueType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issuetype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
