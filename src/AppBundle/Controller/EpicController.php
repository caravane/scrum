<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Epic;
use AppBundle\Form\EpicType;

/**
 * Epic controller.
 *
 */
class EpicController extends Controller
{

    /**
     * Lists all Epic entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Epic')->findAll();

        return $this->render('AppBundle:Epic:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Epic entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Epic();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('epic_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Epic:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Epic entity.
     *
     * @param Epic $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Epic $entity)
    {
        $form = $this->createForm(new EpicType(), $entity, array(
            'action' => $this->generateUrl('epic_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Epic entity.
     *
     */
    public function newAction()
    {
        $entity = new Epic();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Epic:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Epic entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Epic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epic entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Epic:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Epic entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Epic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epic entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Epic:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Epic entity.
    *
    * @param Epic $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Epic $entity)
    {
        $form = $this->createForm(new EpicType(), $entity, array(
            'action' => $this->generateUrl('epic_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Epic entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Epic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Epic entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('epic_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Epic:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Epic entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Epic')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Epic entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('epic'));
    }

    /**
     * Creates a form to delete a Epic entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('epic_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
