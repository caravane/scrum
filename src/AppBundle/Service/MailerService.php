<?php
namespace AppBundle\Service;


use AppBundle\Entity\Issue;

class MailerService {

	private $em;
	private $mailer;
	private $security_token;
	private $templating;
	private $mailer_send_from_email;
	private $auditReader;

	public function __construct($em, $mailer, $security_token, $templating, $auditReader, $mailer_send_from_email) {
		$this->mailer = $mailer;
		$this->em = $em;
		$this->security_token = $security_token;
		$this->mailer_send_from_email = $mailer_send_from_email;
		$this->templating = $templating;
		$this->auditReader = $auditReader;
	}

	public function sendUpdateIssue(Issue $issue) {
		$newRev = $this->auditReader->getCurrentRevision(
	        'AppBundle\Entity\Issue',
	        $id = $issue->getId()
	    );
		$oldRev=$newRev-1;
        $ids = array($issue->getId());
        $diff = $this->auditReader->diff('AppBundle\Entity\Issue', $ids, $oldRev, $newRev);

//print_r($diff);
		$template_vars= array(
			'issue'=>$issue,
			'diff' => $diff,
			'user'=>$this->security_token->getToken()->getUser()
		);
		$from = $this->mailer_send_from_email;
		$to=array($issue->getReporter()->getEmail());
		if($issue->getAssignee()) {
			$to[]=$issue->getAssignee()->getEmail();
		}
		$template ="AppBundle:Mailer:issue.html.twig";
		$subject = "[".$issue->getName()."] ".$issue->getSummary();
		$this->sendEmail($subject, $from, $to, $template, $template_vars);
	}







	private function sendEmail($subject, $from, $to, $template, array $template_vars) {

		$message = \Swift_Message::newInstance()
	        ->setSubject($subject)
	        ->setFrom($from)
	        ->setTo($to)
	        ->setBody($this->templating->render($template, $template_vars))
	    ;
	    if($this->mailer->send($message)) {
	    	echo "message sent";
	    }
	}
}



