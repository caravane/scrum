<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Setting;
use AppBundle\Entity\IssueType;
use AppBundle\Entity\IssueStatus;
use AppBundle\Entity\Priority;

class SetupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:setup')
            ->setDescription('Application first launch')
            ->addArgument('name', InputArgument::OPTIONAL, 'Application name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if (!$name) {
            $name = 'Scrumapp';
        }
        $em= $this->getContainer()->get('doctrine')->getManager();
        if(!$appSettings=$em->getRepository('AppBundle:Setting')->findOneByShortname("app")) {
            $appSetting=new Setting();
            $appSetting->setName($name);
            $appSetting->setShortname('app');
            $appSetting->setParams(json_encode(array('name'=>'Scrum App Name')));
            $em->persist($appSetting);
        }

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

        $output->writeln("Setup OK");
    }
}