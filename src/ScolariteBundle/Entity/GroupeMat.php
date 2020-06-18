<?php

namespace ScolariteBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupeMat
 *
 * @ORM\Table(name="groupemat")
 * @ORM\Entity(repositoryClass="ScolariteBundle\Repository\GroupeMatRepository")
 */
class GroupeMat
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
     /**
     * @var \Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumn(name="id_groupe", referencedColumnName="Id_Groupe")
     * 
     */
    private $groupe;
     
    
    public function getGroupe()
    {
        return $this->groupe;
    }

    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere" , cascade={"persist"})
     * @ORM\JoinColumn(name="id_matiere", referencedColumnName="Id_Matiere" , onDelete="CASCADE")
     * 
     */
    private $matiere;
     
    
    public function getMatiere()
    {
        return $this->matiere;
    }

    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    
}
