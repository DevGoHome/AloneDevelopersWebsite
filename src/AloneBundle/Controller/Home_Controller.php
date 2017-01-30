<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Home_Controller extends Controller
{
    /**
     * @Route("/home", name="index")
     */
    public function indexAction()
    {
        return $this->render('@Alone/Default/index.html.twig');
    }

    /**
     * @Route("/", name="unnamed")
     */
    public function unnamedAction()
    {
        return $this->redirectToRoute('index');
    }
}
