<?php

namespace ScolariteBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tab_demande
 *
 * @ORM\Table(name="enseignant")
 * @ORM\Entity(repositoryClass="ScolariteBundle\Repository\EnseignantRepository")
 */
class Enseignant
{
    public function __toString()
    {
        return $this->nom;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id_enseignant", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_enseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer")
     */
    private $cin;

    /**
     * @var int
     *
     * @ORM\Column(name="numtel", type="integer")
     */
    private $numTel;


    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=false)
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    
    private $cv;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="etude", type="string", length=255)
     */
    private $etude;




    /**
     * @return int
     */
    public function getIdEnseignant()
    {
        return $this->id_enseignant;
    }

    /**
     * @param int $$id_enseignant
     */
    public function setIdDemande(int $id_enseignant)
    {
        $this->id_enseignant = $id_enseignant;
    }




    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Enseignant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Enseignant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return Enseignant
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set numTel
     *
     * @param integer $numTel
     *
     * @return Enseignant
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return Enseignant
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }


    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Enseignant
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
     * Set etude
     *
     * @param string $etude
     *
     * @return Enseignant
     */
    public function setEtude($etude)
    {
        $this->etude = $etude;

        return $this;
    }

    /**
     * Get etude
     *
     * @return string
     */
    public function getEtude()
    {
        return $this->etude;
    }

}

