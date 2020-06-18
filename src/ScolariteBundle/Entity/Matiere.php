<?php

namespace ScolariteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Unique;
use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="ScolariteBundle\Repository\MatiereRepository")
 */
class Matiere
{
    public function __toString()
    {
        return $this->nomMatiere;
    }
    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Matiere", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $Id_Matiere;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Matiere", type="string", length=255)
     */
    private $nomMatiere;

    /**
     * @var int
     *
     * @ORM\Column(name="Coef_Matiere", type="integer")

     */
    private $coefMatiere;

    /**
     * @var int
     *
     * @ORM\Column(name="Nbre_Heure_Matiere", type="integer")
     */
    private $nbreHeureMatiere;

   

    /**
     * @return int
     */
    public function getIdMatiere()
    {
        return $this->Id_Matiere;
    }

    /**
     * @param int $Id_Matiere
     */
    public function setIdMatiere($Id_Matiere)
    {
        $this->Id_Matiere = $Id_Matiere;
    }



    /**
     * Set nomMatiere
     *
     * @param string $nomMatiere
     *
     * @return Matiere
     */
    public function setNomMatiere($nomMatiere)
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    /**
     * Get nomMatiere
     *
     * @return string
     */
    public function getNomMatiere()
    {
        return $this->nomMatiere;
    }

    /**
     * Set coefMatiere
     *
     * @param integer $coefMatiere
     *
     * @return Matiere
     */
    public function setCoefMatiere($coefMatiere)
    {
        $this->coefMatiere = $coefMatiere;

        return $this;
    }

    /**
     * Get coefMatiere
     *
     * @return int
     */
    public function getCoefMatiere()
    {
        return $this->coefMatiere;
    }

    /**
     * Set nbreHeureMatiere
     *
     * @param integer $nbreHeureMatiere
     *
     * @return Matiere
     */
    public function setNbreHeureMatiere($nbreHeureMatiere)
    {
        $this->nbreHeureMatiere = $nbreHeureMatiere;

        return $this;
    }

    /**
     * Get nbreHeureMatiere
     *
     * @return int
     */
    public function getNbreHeureMatiere()
    {
        return $this->nbreHeureMatiere;
    }


      /**
     * @var \Enseignant
     *
     * @ORM\ManyToOne(targetEntity="Enseignant"  , cascade={"persist"})
     * @ORM\JoinColumn(name="menseignant", referencedColumnName="id_enseignant" )
     * 
     */
    private $enseignant;
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;

        return $this;
    }
   
    
}
