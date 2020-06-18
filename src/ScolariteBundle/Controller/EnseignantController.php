<?php

namespace ScolariteBundle\Controller;
use ScolariteBundle\Entity\Enseignant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponce;
use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class EnseignantController extends Controller
{
    public function AfficheEnseignantAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignant = $this->getDoctrine()->getManager()->getRepository(Enseignant::class)->findAll();
        return $this->render("@Scolarite/Enseignant/AfficheEnseignant.html.twig",array('Enseignant' => $Enseignant , 'user'=> $this->getUser()));


    }
    public function SupprimerEnseignantAction($IdEnseignant)
    {
        $em = $this->getDoctrine()->getManager();
        $Enseignant = $em->getRepository(Enseignant::class)->find($IdEnseignant);
        $em->remove($Enseignant);
        $em->flush();
        return $this->redirectToRoute('scolariteafficheEnseignant');

    }
}
