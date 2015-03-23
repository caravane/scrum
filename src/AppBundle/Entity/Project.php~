<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;





/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="shortname", type="string", length=25)
     */
    private $shortname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     */
    private $leader;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\User", inversedBy="projects")
     */
    private $user;

     /**
     * @var string
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Issue", mappedBy="project")
     */
    private $issues;

    /**
     * @ORM\ManyToMany(targetEntity="Board", mappedBy="project")
     **/
   private $board;


    public function __toString() {
        return $this->name;
    }


    public function hasUser($user) {
        if($this->leader==$user) {
            return true;
        }
        foreach($this->user as $u) {
            if($u==$user) {
                return true;
            }
        }
        return false;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->issues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
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
     * Set leader
     *
     * @param \AppBundle\Entity\User $leader
     * @return Project
     */
    public function setLeader(\AppBundle\Entity\User $leader = null)
    {
        $this->leader = $leader;

        return $this;
    }

    /**
     * Get leader
     *
     * @return \AppBundle\Entity\User
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     * @return Project
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add issues
     *
     * @param \AppBundle\Entity\Issue $issues
     * @return Project
     */
    public function addIssue(\AppBundle\Entity\Issue $issues)
    {
        $this->issues[] = $issues;

        return $this;
    }

    /**
     * Remove issues
     *
     * @param \AppBundle\Entity\Issue $issues
     */
    public function removeIssue(\AppBundle\Entity\Issue $issues)
    {
        $this->issues->removeElement($issues);
    }

    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssues($type='work')
    {
        if($type=='plan') {
            return $this->issues;
        }
        $issues=array();
        foreach($this->issues as $issue) {
            $issues[$issue->getStatus()->getShortname()][]=$issue;
        }
        return $issues;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     * @return Project
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Add board
     *
     * @param \AppBundle\Entity\Board $board
     * @return Board
     */
    public function addBoard(\AppBundle\Entity\Board $board)
    {
        $this->board[] = $board;

        return $this;
    }

    /**
     * Remove board
     *
     * @param \AppBundle\Entity\Board $board
     */
    public function removeBoard(\AppBundle\Entity\Board $board)
    {
        $this->board->removeElement($board);
    }

    /**
     * Get board
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBoard()
    {
        return $this->board;
    }
}
