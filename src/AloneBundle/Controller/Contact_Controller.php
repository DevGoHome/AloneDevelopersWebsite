<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Contact_Controller extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(){

        return $this->render('@Alone/Contact/contact.html.twig');
    }
}
