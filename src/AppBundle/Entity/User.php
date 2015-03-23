<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Project", mappedBy="user")
     */
    private $project;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


     public function __toString() {
        return $this->username;
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
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     * @return User
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



    public function getBoard() {
        $boards=array();
        foreach($this->getProject() as $project) {

             foreach($project->getBoard() as $board) {
                $boards[$board->getId()]=$board;
            }
        }
        return $boards;
    }






}
