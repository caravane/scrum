<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Setting;
use AppBundle\Entity\IssueType;
use AppBundle\Entity\IssueStatus;
use AppBundle\Entity\Priority;


class DefaultController extends Controller
{
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();
		if(!$appSettings=$em->getRepository('AppBundle:Setting')->findOneByShortname("app")) {
			$appSetting=new Setting();
			$appSetting->setName("Application");
			$appSetting->setShortname('app');
			$appSetting->setParams(json_encode(array('name'=>'Scrum App Name')));
			$em->persist($appSetting);
			$em->flush();
			$this->redirect($this->generateUrl('app_setup'));
		}
		 return $this->render('AppBundle:Default:index.html.twig', array());
	}

	public function settingsAction() {
		$em = $this->getDoctrine()->getManager();

	}


	public function setupAction() {
		$em = $this->getDoctrine()->getManager();
		if(!$issueTypes=$em->getRepository('AppBundle:IssueType')->findAll()) {

			$types=array(
				'bug'=>'Bug',
				'task'=>'Task',
				'improvement'=>"Inprovement",
				'newfeature'=>"New feature"
			);
			foreach($types as $shortname=>$name) {
				$t=new IssueType();
				$t->setName($name);
				$t->setShortname($shortname);
				$em->persist($t);
			}
		}

		if(!$issueStatus=$em->getRepository('AppBundle:IssueStatus')->findAll()) {
			$status=array(
				'todo'=>'To do',
				'inprogress'=>'In progress',
				'inqualification'=>"In qualification",
				'done'=>"Done"
			);
			foreach($status as $shortname=>$name) {
				$s=new IssueStatus();
				$s->setName($name);
				$s->setShortname($shortname);
				$em->persist($s);
			}
		}

		if(!$issuePriorities=$em->getRepository('AppBundle:Priority')->findAll()) {
			$priorities=array(
				'critical'=>'Critical',
				'blocker'=>'Blocker',
				'major'=>"Major",
				'minor'=>"Minor",
				'trivial'=>"Trivial"
			);
			foreach($priorities as $shortname=>$name) {
				$p=new Priority();
				$p->setName($name);
				$p->setShortname($shortname);
				$em->persist($p);
			}
		}

		$em->flush();
		return $this->redirect($this->generateUrl('project'));
	}





}
