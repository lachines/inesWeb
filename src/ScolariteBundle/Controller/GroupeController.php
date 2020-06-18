<?php

namespace ScolariteBundle\Controller;
use ScolariteBundle\Form\GroupeType;
use ScolariteBundle\Entity\Groupe;
use ScolariteBundle\Entity\Matiere;
use ScolariteBundle\Entity\GroupeMat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponce;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\HttpFoundation\Response;

class GroupeController extends Controller
{
    public function ajoutGroupeAction(Request $request)
    {
        $Groupe = new Groupe();
        $form = $this->createForm(GroupeType::class,$Groupe);
        $form->handleRequest($request);
        //$Groupe->setMatiere(null);

        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Groupe);
            $em->flush();
            //return $this->redirectToRoute('');
            return $this->redirectToRoute('scolariteafficheGroupe');
        }
        return $this->render("@Scolarite/Groupe/addGroupe.html.twig",array('form'=>$form->createView() , 'user'=> $this->getUser()));

    }
    public function AfficheGroupeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Groupe = $this->getDoctrine()->getManager()->getRepository(Groupe::class)->findAll();
        $GroupeMat = $this->getDoctrine()->getManager()->getRepository(GroupeMat::class)->findAll();
        return $this->render("@Scolarite/Groupe/AfficheGroupe.html.twig",array('GroupeMat' => $GroupeMat,'Groupe' => $Groupe , 'user'=> $this->getUser()));


    }

    public function SupprimerGroupeAction($IdGroupe)
    {
        $em = $this->getDoctrine()->getManager();
        $Groupe = $em->getRepository(Groupe::class)->find($IdGroupe);
        $em->remove($Groupe);
        $em->flush();
        return $this->redirectToRoute('scolariteafficheGroupe');

    }
    public function ModifierGroupeAction( Request $request,$IdGroupe)
    {
         
        $Groupe= new Groupe();
        $em=$this->getDoctrine()->getManager();
        $Groupe=$em->getRepository(Groupe::class)->find($IdGroupe);
        $Matieres = $em->getRepository(Matiere::class)->findAll();
        $GroupeMat = $em->getRepository(GroupeMat::class)->findBy(['groupe'=>$Groupe]);
        $form=$this->createForm(GroupeType::class,$Groupe);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('scolariteafficheGroupe');
        }

        return $this->render('@Scolarite/Groupe/ModifierGroupe.html.twig', array('id'=>$IdGroupe,'GroupeMat'=>$GroupeMat,'Matieres'=>$Matieres,'form' => $form->createView() , 'user'=> $this->getUser()));
    }
    public function addgmAction($id,Request $request){
        $em=$this->getDoctrine()->getManager();
        $Matiere = $em->getRepository(Matiere::class)->find($request->request->get("matiere"));
        $Groupe = $em->getRepository(Groupe::class)->find($id);
        $gm = new GroupeMat();
        $gm->setMatiere($Matiere);
        $gm->setGroupe($Groupe);
        $em->persist($gm);
        $em->flush();
        return $this->redirect("/modifierGroupe/".$id);

    }
    public function removegmAction($id){
        $em=$this->getDoctrine()->getManager();
        $gm = $em->getRepository(GroupeMat::class)->find($id);
        $em->remove($gm);
        $em->flush();
        return $this->redirect("/modifierGroupe/".$id);

    }
    public function searchAction(Request $request){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer, $encoders);

        $groupe = $request->request->get("groupe");
        $em = $this->getDoctrine()->getManager();
    
        $sql = "SELECT * FROM groupe WHERE Nom_Groupe LIKE '%".$groupe."%'";
        //$sql1 = "SELECT * FROM `matiere`";
        $result = $em->getConnection()->prepare($sql);
       // $result1 = $em->getConnection()->prepare($sql1);
        $result->execute();
        //$result1->execute();
        $groupes = $result->fetchAll();
        //$matieres = $result1->fetchAll();
        //$matierese = array();
           


        //$matieres = $this->getDoctrine()->getRepository(Event::class)->findAll(); 

       
        $jsonContent = $serializer->serialize($groupes, 'json');
        return new Response($jsonContent);

    }
    public function triAction(Request $request){
        

        $field = $request->request->get("field");
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM `groupe` ORDER BY $field ";
        $result = $em->getConnection()->prepare($sql);
        
        $result->execute();
        
        $Groupe = $result->fetchAll();
        // returns an array of Product objects
        

        //$em = $this->getDoctrine()->getManager();
    
        //$Matiere = $em->getRepository(Matiere::class)->findAll();
        
        //$matieres = $this->getDoctrine()->getRepository(Event::class)->findAll(); 
        return $this->render('@Scolarite/Groupe/triGroupe.html.twig', array('user'=> $this->getUser(),'Groupe' => $Groupe ));
    
    }

}
