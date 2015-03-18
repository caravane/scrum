<?php

namespace AppBundle\Twig;


class AppExtension extends \Twig_Extension
{

	protected $em;

	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
			$this->em = $em;
	}

	public function getGlobals()
	{
		$settings=array();
		$allSettings=$this->em->getRepository('AppBundle:Setting')->findAll();
		foreach($allSettings as $setting) {
			$settings[$setting->getShortname()]=$setting;
		}
		return array(
				"_settings" => $settings,
		);
	}


	public function getName()
	{
			return 'app_extension';
	}
}
