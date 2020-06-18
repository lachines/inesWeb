<?php

namespace ScolariteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->getUser()){
            $user = $this->getUser();
            if ( $user->getRoles()[0] == "ROLE_USER" ){
                return $this->render('ScolariteBundle:user:home.html.twig',['user' => $user]);
            }else if ($user->getRoles()[0] == "ROLE_ADMIN"){
                return $this->render('ScolariteBundle:admin:home.html.twig',['user' => $user]);
            }
        }
        else{
            return $this->render('ScolariteBundle:Default:index.html.twig');
        }
       
    }
}
