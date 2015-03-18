<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\IssueRepository")
 */
class Issue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Project", inversedBy="issues")
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\IssueStatus")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\IssueType")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Priority", inversedBy="issues")
     */
    private $priority;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="datetime", nullable=true )
     */
    private $dueDate;

    /**
     * @var string
     *
     * @ORM\Column(name="component", type="string", length=255, nullable=true )
     */
    private $component;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Version", inversedBy="issue_version")
     * @ORM\JoinTable(
     *     name="issue_version", 
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="version_id", referencedColumnName="id")}
     * )
     */
    private $version;

   /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Version", inversedBy="issue_fixVersion")
     * @ORM\JoinTable(
     *     name="issue_fixversion", 
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="version_id", referencedColumnName="id")}
     * )
     */
    private $fixVersion;

    /**
     * @var string
     *
     ** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     */
    private $assignee;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     */
    private $reporter;

    /**
     * @var string
     *
     * @ORM\Column(name="environment", type="string", length=255, nullable=true )
     */
    private $environment;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="original_estimate", type="string", length=255, nullable=true )
     */
    private $original_estimate;

    /**
     * @var string
     *
     * @ORM\Column(name="remaining_estimate", type="string", length=255, nullable=true )
     */
    private $remaining_estimate;

    /**
     * @var string
     *
     * @ORM\Column(name="labels", type="string", length=255, nullable=true )
     */
    private $labels;

    /**
     * @var string
     *
      * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Epic")
     */
    private $epic;

    /**
     * @var string
     *
      * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Sprint")
     */
    private $sprint;

    

    public function getName() {
        return $this->project->getShortname()."-".$this->getId();
    }


     /**
     * Constructor
     */
    public function __construct()
    {
        $this->version = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fixVersion = new \Doctrine\Common\Collections\ArrayCollection();
    }
   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Issue
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Issue
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set component
     *
     * @param string $component
     * @return Issue
     */
    public function setComponent($component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return string 
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Set environment
     *
     * @param string $environment
     * @return Issue
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Get environment
     *
     * @return string 
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Issue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set original_estimate
     *
     * @param string $originalEstimate
     * @return Issue
     */
    public function setOriginalEstimate($originalEstimate)
    {
        $this->original_estimate = $originalEstimate;

        return $this;
    }

    /**
     * Get original_estimate
     *
     * @return string 
     */
    public function getOriginalEstimate()
    {
        return $this->original_estimate;
    }

    /**
     * Set remaining_estimate
     *
     * @param string $remainingEstimate
     * @return Issue
     */
    public function setRemainingEstimate($remainingEstimate)
    {
        $this->remaining_estimate = $remainingEstimate;

        return $this;
    }

    /**
     * Get remaining_estimate
     *
     * @return string 
     */
    public function getRemainingEstimate()
    {
        return $this->remaining_estimate;
    }

    /**
     * Set labels
     *
     * @param string $labels
     * @return Issue
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Get labels
     *
     * @return string 
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     * @return Issue
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\IssueStatus $status
     * @return Issue
     */
    public function setStatus(\AppBundle\Entity\IssueStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\IssueStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\IssueType $type
     * @return Issue
     */
    public function setType(\AppBundle\Entity\IssueType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\IssueType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set priority
     *
     * @param \AppBundle\Entity\Priority $priority
     * @return Issue
     */
    public function setPriority(\AppBundle\Entity\Priority $priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return \AppBundle\Entity\Priority 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Add version
     *
     * @param \AppBundle\Entity\Version $version
     * @return Issue
     */
    public function addVersion(\AppBundle\Entity\Version $version)
    {
        $this->version[] = $version;

        return $this;
    }

    /**
     * Remove version
     *
     * @param \AppBundle\Entity\Version $version
     */
    public function removeVersion(\AppBundle\Entity\Version $version)
    {
        $this->version->removeElement($version);
    }

    /**
     * Get version
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Add fixVersion
     *
     * @param \AppBundle\Entity\Version $fixVersion
     * @return Issue
     */
    public function addFixVersion(\AppBundle\Entity\Version $fixVersion)
    {
        $this->fixVersion[] = $fixVersion;

        return $this;
    }

    /**
     * Remove fixVersion
     *
     * @param \AppBundle\Entity\Version $fixVersion
     */
    public function removeFixVersion(\AppBundle\Entity\Version $fixVersion)
    {
        $this->fixVersion->removeElement($fixVersion);
    }

    /**
     * Get fixVersion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFixVersion()
    {
        return $this->fixVersion;
    }

    /**
     * Set assignee
     *
     * @param \AppBundle\Entity\User $assignee
     * @return Issue
     */
    public function setAssignee(\AppBundle\Entity\User $assignee = null)
    {
        $this->assignee = $assignee;

        return $this;
    }

    /**
     * Get assignee
     *
     * @return \AppBundle\Entity\User 
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * Set reporter
     *
     * @param \AppBundle\Entity\User $reporter
     * @return Issue
     */
    public function setReporter(\AppBundle\Entity\User $reporter = null)
    {
        $this->reporter = $reporter;

        return $this;
    }

    /**
     * Get reporter
     *
     * @return \AppBundle\Entity\User 
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * Set epic
     *
     * @param \AppBundle\Entity\Epic $epic
     * @return Issue
     */
    public function setEpic(\AppBundle\Entity\Epic $epic = null)
    {
        $this->epic = $epic;

        return $this;
    }

    /**
     * Get epic
     *
     * @return \AppBundle\Entity\Epic 
     */
    public function getEpic()
    {
        return $this->epic;
    }

    /**
     * Set sprint
     *
     * @param \AppBundle\Entity\Sprint $sprint
     * @return Issue
     */
    public function setSprint(\AppBundle\Entity\Sprint $sprint = null)
    {
        $this->sprint = $sprint;

        return $this;
    }

    /**
     * Get sprint
     *
     * @return \AppBundle\Entity\Sprint 
     */
    public function getSprint()
    {
        return $this->sprint;
    }



    public function getRemaining() {
        if($this->remaining_estimate) {
            return $this->remaining_estimate;
        }
        return "Unestimated";
    }
   

}
