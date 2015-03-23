<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Board
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BoardRepository")
 */
class Board
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
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="board")
     **/
   private $project;


   public function __toString() {
    return $this->name;
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
     * @return Board
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
     * Constructor
     */
    public function __construct()
    {
        $this->board = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     * @return Board
     */
    public function addProject(\AppBundle\Entity\Project $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\Project $project
     */
    public function removeProject(\AppBundle\Entity\Project $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Get project
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProject()
    {
        return $this->project;
    }


    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssues($type='work')
    {
        $issues=array();
        if($type=='plan') {
            foreach($this->project as $project) {
                foreach($project->getIssues($type) as $issue) {
                    $issues[]=$issue;
                }
            }
            return $issues;
        }

        foreach($this->project as $project) {
            foreach($project->getIssues($type) as $tissues) {
                foreach($tissues as $issue) {
                    $issues[$issue->getStatus()->getShortname()][]=$issue;
                }
            }
        }

        return $issues;
    }
}
