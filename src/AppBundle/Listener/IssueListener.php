<?php
namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Issue;
use AppBundle\Service\MailerService;

class IssueListener
{
	private $mailer;

	public function __construct(MailerService $mailer) {
		$this->mailer = $mailer;
	}
    public function prePersist(Issue $issue, LifecycleEventArgs $event)
    {
        // Checks the user is new.
        if ($issue->getId() === null) {
            // Implement all logic needed in order to send a welcome email...
        }
    }

    public function postPersist(Issue $issue, LifecycleEventArgs $event)
    {
        // Checks the user is new.
        if ($issue->getId() === null) {
            // Implement all logic needed in order to send a welcome email...
        }
    }


    public function postUpdate(Issue $issue, LifecycleEventArgs $event)
    {
		$this->mailer->sendUpdateIssue($issue);
    }
}