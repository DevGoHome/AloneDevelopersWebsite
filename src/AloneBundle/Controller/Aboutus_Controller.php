<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class Aboutus_Controller extends Controller
{

    /**
     * @Route("/AboutUs", name="aboutUs")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutUsAction(){

        return $this->render('@Alone/AboutUs/about_us.html.twig');
    }

}
