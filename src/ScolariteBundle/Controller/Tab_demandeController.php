<?php

namespace ScolariteBundle\Controller;
use Yamilovs\Bundle\SmsBundle\Service\ProviderManager;
use Yamilovs\Bundle\SmsBundle\Sms\Sms;
use ScolariteBundle\Form\Tab_demandeType;
use ScolariteBundle\Entity\Tab_demande;
use ScolariteBundle\Entity\Enseignant;
use ScolariteBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponce;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Tab_demandeController extends Controller
{
    public function ajoutTab_demandeAction(Request $request)
    {
        $Tab_demande = new Tab_demande();
        $form = $this->createForm(Tab_demandeType::class,$Tab_demande);
        $form->handleRequest($request);


        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
           
            /** @var UploadedFile $file */
            $file = $Tab_demande->getCVDemande();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('pdf_directory'), $filename);
            $Tab_demande->setCVDemande($filename);


            $Tab_demande->setEtat('EN COURS');
            $Tab_demande->setQuiz(0);
            $Tab_demande->setUser($this->getUser()->getId());
            $em->persist($Tab_demande);
            $em->flush();
            return $this->redirect('/'.$Tab_demande->getIdDemande().'/quiz');
            //return $this->redirectToRoute('scolariteafficheMatiere');
        }
        $em = $this->getDoctrine()->getManager();
        $demande = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->findBy(['user'=>$this->getUser()->getId()]);
        //return new Response(count($demande));
        return $this->render("@Scolarite/Tab_demande/addTab_demande.html.twig",array('first'=>count($demande),'form'=>$form->createView()));

    }


    public function AfficheQuizAction($id){
            return $this->render("@Scolarite/Tab_demande/quiz.html.twig",array('id' => $id));
    }

    public function afficheDemandeAdminAction(){
        if ($this->getUser()){
            if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){
                $demandes = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->findBy(['etat'=>'EN COURS']);
                return $this->render("@Scolarite/Tab_demande/afficheadmin.html.twig",[ 'Demandes'=> $demandes , 'user'=> $this->getUser() ,'cat'=> 0 ]);
       
            }
            
        }
        return $this->redirect('/');
 }

 public function afficheDemandeRAdminAction(){
    if ($this->getUser()){
        if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){
            $demandes = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->findBy(['etat'=>'REFUSER']);
            return $this->render("@Scolarite/Tab_demande/afficheadmin.html.twig",[ 'Demandes'=> $demandes , 'user'=> $this->getUser() ,'cat'=> 1 ]);
   
        }
        
    }
    return $this->redirect('/');
}

public function afficheDemandeAAdminAction(){
    if ($this->getUser()){
        if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){
            $demandes = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->findBy(['etat'=>'ACCEPTER']);
            return $this->render("@Scolarite/Tab_demande/afficheadmin.html.twig",[ 'Demandes'=> $demandes , 'user'=> $this->getUser() ,'cat'=> 2  ]);
   
        }
        
    }
    return $this->redirect('/');
}

    public function accepterDemandeAdminAction($id){
        if ($this->getUser()){
            if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){
                $demande = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->find($id);
                
                $demande->setEtat("ACCEPTER");
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $enseignant = new Enseignant();

                $enseignant->setNom($demande->getNomDemande());
                $enseignant->setPrenom($demande->getPrenomDemande());
                $enseignant->setCin($demande->getCinDemande());
                $enseignant->setNumTel($demande->getNumTelDemande());
                $enseignant->setDateNaissance($demande->getDateNaissance());
                $enseignant->setCv($demande->getCVDemande());
                $enseignant->setEtude($demande->getEtudeDemande());

                $em = $this->getDoctrine()->getManager();
                $em->persist($enseignant);
                $em->flush();

                $demandeur = $this->getDoctrine()->getManager()->getRepository(User::class)->find( $demande->getUser() );
                $mail = $demandeur->getEmail();
                //echo $mail;

                // send mail here 
                $message = \Swift_Message::newInstance()
                        ->setSubject('Acceptation du demande')
                        ->setFrom('hamdaouiwassim@gmail.com')
                        ->setTo($mail)
                        ->setBody('Votre demande a ete accepte tu sera ajouté a la liste des enseignants');
                $resultat = $this->get('mailer')->send($message);
                var_dump($resultat);
                // end send mail 
                return $this->redirect('/afficheDemandeAdmin');

            }
            
        }
        return $this->redirect('/');


    }
    
    public function refuserDemandeAdminAction($id){
        if ($this->getUser()){
            if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){
                
                $demande = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->find($id);
                
                $demande->setEtat("REFUSER");
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                
                
                $demandeur = $this->getDoctrine()->getManager()->getRepository(User::class)->find( $demande->getUser() );
                $mail = $demandeur->getEmail();
                // send mail here 

                $message = \Swift_Message::newInstance()
                                        ->setSubject('Refue du demande')
                                        ->setFrom('hamdaouiwassim@gmail.com')
                                        ->setTo($mail)
                                        ->setBody('Votre demande a ete refuser');
                        $this->get('mailer')->send($message);

                // end send mail
                return $this->redirect('/afficheDemandeAdmin');
            }
            
        }
        return $this->redirect('/');

    }

    public function QuizSendAction(Request $request){

        $result = 0;
        $id = $request->request->get('iddemande');

        $q1 = $request->request->get('q1');
        $q2 = $request->request->get('q2');
        $q3 = $request->request->get('q3');
        $q4 = $request->request->get('q4');
        $q5 = $request->request->get('q5');
        $q6 = $request->request->get('q6');
       

        if ($q1){
                foreach( $q1 as $q ){
                    if ($q == 1 ){
                            $result++;
                    }else if ( $result > 0 ){
                        $result--;
                    }

                }
        }

        if ($q2){
            foreach( $q2 as $q ){
                if ($q == 1 ){
                        $result++;
                }else if ( $result > 0 ){
                    $result--;
                }

            }
        }

        if ($q3){
            foreach( $q3 as $q ){
                if ($q == 1 ){
                        $result++;
                }else if ( $result > 0 ){
                    $result--;
                }

            }
        }

        if ($q4){
            foreach( $q4 as $q ){
                if ($q == 1 ){
                        $result++;
                }else if ( $result > 0 ){
                    $result--;
                }

            }
        }

        if ($q5){
            foreach( $q5 as $q ){
                if ($q == 1 ){
                        $result++;
                }else if ( $result > 0 ){
                    $result--;
                }

            }
        }

        if ($q6){
            foreach( $q6 as $q ){
                if ($q == 1 ){
                        $result++;
                }else if ( $result > 0 ){
                    $result--;
                }

            }
        }
        echo $id;
        $demande = $this->getDoctrine()->getManager()->getRepository(Tab_demande::class)->find($id);       
        $demande->setQuiz($result);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirect('/');

    }


    public function triAction(Request $request){
        

        $field = $request->request->get("field");
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM `tab_demande` ORDER BY $field ";
        $result = $em->getConnection()->prepare($sql);
        
        $result->execute();
        
        $demandes = $result->fetchAll();
        // returns an array of Product objects
        

        //$em = $this->getDoctrine()->getManager();
    
        //$Matiere = $em->getRepository(Matiere::class)->findAll();
        
        //$matieres = $this->getDoctrine()->getRepository(Event::class)->findAll(); 
        return $this->render('@Scolarite/Tab_demande/tritabdemande.html.twig', array('user'=> $this->getUser(),'Demandes' => $demandes , 'cat'=> 2 ));
    
    }


    public function newDemandeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $created_at = date("Y-m-d");
        $Tab_demande = new Tab_demande();
        $Tab_demande->setNomDemande($request->get('nomDemande'));
        $Tab_demande->setPrenomDemande($request->get('prenomDemande'));
        $Tab_demande->setCinDemande($request->get('cinDemande'));
        $Tab_demande->setNumTelDemande($request->get('numTelDemande'));
        $Tab_demande->setCVDemande($request->get('cVDemande'));
        $Tab_demande->setDateNaissance(new \DateTime($created_at));
        $Tab_demande->setEtudeDemande($request->get('etudeDemande'));
        $Tab_demande->setPosteDemande($request->get('posteDemande'));
        $Tab_demande->setEtat('EN COURS');
        $Tab_demande->setQuiz(0);
        $Tab_demande->setUser(2);
        $Nom_demande = $Tab_demande->getNomDemande();


        $em->persist($Tab_demande);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Tab_demande);
        return new JsonResponse($formatted);
    }


    
}
