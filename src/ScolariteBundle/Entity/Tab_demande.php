<?php

namespace ScolariteBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Unique;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tab_demande
 *
 * @ORM\Table(name="tab_demande")
 * @ORM\Entity(repositoryClass="ScolariteBundle\Repository\Tab_demandeRepository")
 */
class Tab_demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Demande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $Id_Demande;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Demande", type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Your demande name must be at least {{ limit }} characters long",
     *      
     *      
     * )
     */
    private $nomDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom_Demande", type="string", length=255)
     * @Assert\NotNull
     *  @Assert\Length(
     *      min = 5,
     *      minMessage = "Your demande name must be at least {{ limit }} characters long",
     *      
     *      
     * )
     */
    private $prenomDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="Cin_Demande", type="integer")
     *  @Assert\Length(
     *      min = 5,
     *      minMessage = "Your demande name must be at least {{ limit }} characters long",
     *
     *
     * )
     */
    private $cinDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="Num_Tel_Demande", type="integer")
     * @Assert\Length(min=6)
     * @Assert\NotNull
     */
    private $numTelDemande;


    /**
     * @var string
     *
     * @ORM\Column(name="CV_Demande", type="string", length=255, nullable=false)
     * @Assert\NotNull
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    
    private $cVDemande;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     * @Assert\LessThan("-20 years")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Etude_Demande", type="string", length=255)
     * @Assert\NotNull
     *   @Assert\Length(
     *      min = 5,
     *      minMessage = "Your demande name must be at least {{ limit }} characters long",
     *      
     *      
     * )
     */
    private $etudeDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="Poste_Demande", type="string", length=255)
     * @Assert\NotNull
     *   @Assert\Length(
     *      min = 5,
     *      minMessage = "Your demande name must be at least {{ limit }} characters long",
     *      
     *      
     * )
     */
    private $posteDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", nullable=true, length=255,options={"default": "EN COURS"})
     */
    private $etat;

       /**
     * @var int
     *
     * @ORM\Column(name="resultat_quiz", type="integer", nullable=true,options={"default": "0"})
     */
    private $quiz;
    /**
     * @return int
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param int $quiz
     */
    public function setQuiz(int $quiz)
    {
        $this->quiz = $quiz;
    }




    /**
     * @return int
     */
    public function getIdDemande()
    {
        return $this->Id_Demande;
    }

    /**
     * @param int $Id_Demande
     */
    public function setIdDemande(int $Id_Demande)
    {
        $this->Id_Demande = $Id_Demande;
    }




    /**
     * Set nomDemande
     *
     * @param string $nomDemande
     *
     * @return Tab_demande
     */
    public function setNomDemande($nomDemande)
    {
        $this->nomDemande = $nomDemande;

        return $this;
    }

    /**
     * Get nomDemande
     *
     * @return string
     */
    public function getNomDemande()
    {
        return $this->nomDemande;
    }

    /**
     * Set prenomDemande
     *
     * @param string $prenomDemande
     *
     * @return Tab_demande
     */
    public function setPrenomDemande($prenomDemande)
    {
        $this->prenomDemande = $prenomDemande;

        return $this;
    }

    /**
     * Get prenomDemande
     *
     * @return string
     */
    public function getPrenomDemande()
    {
        return $this->prenomDemande;
    }

    /**
     * Set cinDemande
     *
     * @param integer $cinDemande
     *
     * @return Tab_demande
     */
    public function setCinDemande($cinDemande)
    {
        $this->cinDemande = $cinDemande;

        return $this;
    }

    /**
     * Get cinDemande
     *
     * @return int
     */
    public function getCinDemande()
    {
        return $this->cinDemande;
    }

    /**
     * Set numTelDemande
     *
     * @param integer $numTelDemande
     *
     * @return Tab_demande
     */
    public function setNumTelDemande($numTelDemande)
    {
        $this->numTelDemande = $numTelDemande;

        return $this;
    }

    /**
     * Get numTelDemande
     *
     * @return int
     */
    public function getNumTelDemande()
    {
        return $this->numTelDemande;
    }

    /**
     * Set cVDemande
     *
     * @param string $cVDemande
     *
     * @return Tab_demande
     */
    public function setCVDemande($cVDemande)
    {
        $this->cVDemande = $cVDemande;

        return $this;
    }

    /**
     * Get cVDemande
     *
     * @return string
     */
    public function getCVDemande()
    {
        return $this->cVDemande;
    }


    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Tab_demande
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }






    /**
     * Set etudeDemande
     *
     * @param string $etudeDemande
     *
     * @return Tab_demande
     */
    public function setEtudeDemande($etudeDemande)
    {
        $this->etudeDemande = $etudeDemande;

        return $this;
    }

    /**
     * Get etudeDemande
     *
     * @return string
     */
    public function getEtudeDemande()
    {
        return $this->etudeDemande;
    }

    /**
     * Set posteDemande
     *
     * @param string $posteDemande
     *
     * @return Tab_demande
     */
    public function setPosteDemande($posteDemande)
    {
        $this->posteDemande = $posteDemande;

        return $this;
    }

    /**
     * Get posteDemande
     *
     * @return string
     */
    public function getPosteDemande()
    {
        return $this->posteDemande;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Tab_demande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $user;
     /**
     * Set cinDemande
     *
     * @param integer $cinDemande
     *
     * @return Tab_demande
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

}

