<?php

namespace ScolariteBundle\Controller;
use ScolariteBundle\Form\MatiereType;
use ScolariteBundle\Entity\Matiere;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\HttpFoundation\JsonResponse;








class MatiereController extends Controller
{
    public function ajoutMatiereAction(Request $request)
    {
        $Matiere = new Matiere();
        $form = $this->createForm(MatiereType::class,$Matiere);
        $form->handleRequest($request);


        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Matiere);
            $em->flush();
            //return $this->redirectToRoute('');
            return $this->redirectToRoute('scolariteafficheMatiere');
        }
        return $this->render("@Scolarite/Matiere/addMatiere.html.twig",array('form'=>$form->createView() , 'user'=> $this->getUser()));

    }

    public function AfficheMatiereAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Matiere = $this->getDoctrine()->getManager()->getRepository(Matiere::class)->findAll();
        return $this->render("@Scolarite/Matiere/AfficheMatiere.html.twig",array('Matiere' => $Matiere , 'user'=> $this->getUser()));


    }
    public function printAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Matiere = $this->getDoctrine()->getManager()->getRepository(Matiere::class)->findAll();
        return $this->render("@Scolarite/Matiere/print.html.twig",array('Matiere' => $Matiere , 'user'=> $this->getUser()));


    }
    public function SupprimerMatiereAction($IdMatiere)
    {
        $em = $this->getDoctrine()->getManager();
        $Matiere = $em->getRepository(Matiere::class)->find($IdMatiere);
        $em->remove($Matiere);
        $em->flush();
        return $this->redirectToRoute('scolariteafficheMatiere');

    }
    public function ModifierMatiereAction( Request $request,$IdMatiere)
    {
        $Matiere= new Matiere();
        $em=$this->getDoctrine()->getManager();
        $Matiere=$em->getRepository(Matiere::class)->find($IdMatiere);
        $form=$this->createForm(MatiereType::class,$Matiere);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('scolariteafficheMatiere');
        }

        return $this->render('@Scolarite/Matiere/ModifierMatiere.html.twig', array('form' => $form->createView() ,'user'=> $this->getUser() ));
    }

    public function searchAction(Request $request){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer, $encoders);

        $matiere = $request->request->get("matiere");
        $em = $this->getDoctrine()->getManager();
    
        $sql = "SELECT * FROM `matiere` WHERE `Nom_Matiere` LIKE '%".$matiere."%'";
        $sql1 = "SELECT * FROM `enseignant`";
        $result = $em->getConnection()->prepare($sql);
        $result1 = $em->getConnection()->prepare($sql1);
        $result->execute();
        $result1->execute();
        $matieres = $result->fetchAll();
        $enseignants = $result1->fetchAll();
        $matierese = array();
        foreach($matieres as $matiere){
            foreach($enseignants as $enseignant){
            
                if ( $matiere['menseignant'] == $enseignant['id_enseignant'] ){
                    $matiere['menseignant'] = $enseignant['nom'];
                }

            }
            $matierese[] = $matiere; 
            
        }      


        //$matieres = $this->getDoctrine()->getRepository(Event::class)->findAll(); 

       
        $jsonContent = $serializer->serialize($matierese, 'json');
        return new Response($jsonContent);

    }
    public function triAction(Request $request){
        

        $field = $request->request->get("field");
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM `matiere` ORDER BY $field ";
        $result = $em->getConnection()->prepare($sql);
        
        $result->execute();
        
        $Matiere = $result->fetchAll();
        // returns an array of Product objects
        

        //$em = $this->getDoctrine()->getManager();
    
        //$Matiere = $em->getRepository(Matiere::class)->findAll();
        
        //$matieres = $this->getDoctrine()->getRepository(Event::class)->findAll(); 
        return $this->render('@Scolarite/Matiere/triMatiere.html.twig', array('user'=> $this->getUser(),'Matiere' => $Matiere ));
    
    }
    public function affichageMobileAction()
    {
        $tab = $this->getDoctrine()->getManager()->getRepository('ScolariteBundle:Matiere')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }

    public function findMobileAction($str)
    {
        $em = $this->getDoctrine()->getManager();

        $matieres = $em->getRepository('ScolariteBundle:Matiere')->findEntitiesByString($str);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($matieres);
        return new JsonResponse($formatted);
    }
    public function  triiAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $tri = $request->request->get("trii");

        $entities = $em
            ->getRepository(Matiere::class)
            ->createQueryBuilder('e')
            ->addOrderBy('e.nbreHeureMatiere', 'DESC')
            ->getQuery()
            ->execute();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($entities);
        return new JsonResponse($formatted);

    }

}
