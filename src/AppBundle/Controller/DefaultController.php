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
		
		 return $this->render('AppBundle:Default:index.html.twig', array());
	}

	public function settingsAction() {
		$em = $this->getDoctrine()->getManager();

	}

}
