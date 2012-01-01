<?php

namespace Penfold\GoogleGeolocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('PenfoldGoogleGeolocationBundle:Default:index.html.twig', array('name' => $name));
    }
}
