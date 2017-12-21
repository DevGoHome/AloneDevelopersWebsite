<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class Downloads_Controller extends Controller
{
    /**
     * @Route("/downloads", name="downloads")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Alone/Downloads/downloads.html.twig');
    }
}
