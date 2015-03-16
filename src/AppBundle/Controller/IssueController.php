<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Issue;
use AppBundle\Form\IssueType;

/**
 * Issue controller.
 *
 */
class IssueController extends Controller
{

    /**
     * Lists all Issue issues.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('AppBundle:Issue')->findAll();

        return $this->render('AppBundle:Issue:index.html.twig', array(
            'issues' => $issues,
        ));
    }
    /**
     * Creates a new Issue issue.
     *
     */
    public function createAction(Request $request)
    {
        $issue = new Issue();
        $form = $this->createCreateForm($issue);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($issue);
            $em->flush();

            return $this->redirect($this->generateUrl('project_show', array('id' => $issue->getProject()->getId())));
        }

        return $this->render('AppBundle:Issue:new.html.twig', array(
            'issue' => $issue,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Issue issue.
     *
     * @param Issue $issue The issue
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Issue $issue)
    {
        $form = $this->createForm(new IssueType(), $issue, array(
            'action' => $this->generateUrl('issue_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Issue issue.
     *
     */
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $issue = new Issue();
        if($project_id=$request->request->get('pid')) {

            if($project = $em->getRepository('AppBundle:Project')->find($id)) {
                $issue->setProject($project);
            }
        }
       
        $form   = $this->createCreateForm($issue);

        return $this->render('AppBundle:Issue:new.html.twig', array(
            'issue' => $issue,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Issue issue.
     *
     */
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $template="AppBundle:Issue:show.html.twig";
        if($request->isXmlHttpRequest()) {
            $template="AppBundle:Issue:show_ajax.html.twig";
        }
       

        return $this->render($template, array(
            'issue'      => $issue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Issue issue.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue issue.');
        }

        $editForm = $this->createEditForm($issue);
    

        return $this->render('AppBundle:Issue:edit.html.twig', array(
            'issue'      => $issue,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Issue issue.
    *
    * @param Issue $issue The issue
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Issue $issue)
    {
        $form = $this->createForm(new IssueType(), $issue, array(
            'action' => $this->generateUrl('issue_update', array('id' => $issue->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Issue issue.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $issue = $em->getRepository('AppBundle:Issue')->find($id);

        if (!$issue) {
            throw $this->createNotFoundException('Unable to find Issue issue.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($issue);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('issue_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Issue:edit.html.twig', array(
            'issue'      => $issue,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Issue issue.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $issue = $em->getRepository('AppBundle:Issue')->find($id);

            if (!$issue) {
                throw $this->createNotFoundException('Unable to find Issue issue.');
            }

            $em->remove($issue);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('issue'));
    }

    /**
     * Creates a form to delete a Issue issue by id.
     *
     * @param mixed $id The issue id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issue_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }




    public function reorderAction($id, $status) {
        $em = $this->getDoctrine()->getManager();
        if($status=$em->getRepository('AppBundle:IssueStatus')->findOneByShortname($status)) {
            if($issue=$em->getRepository('AppBundle:Issue')->find($id)) {
                $issue->setStatus($status);
                $em->persist($issue);
                $em->flush();
                return new response('ok');
            }
        }
        return new response('nok');

    }
}
