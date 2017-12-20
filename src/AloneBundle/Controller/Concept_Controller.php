<?php

namespace AloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class Concept_Controller
 * @package AloneBundle\Controller
 */
class Concept_Controller extends Controller
{
    /**
     * @Route("GoHome/concept", name="gh_concept")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Alone/GoHome/go_home_concept.html.twig');
    }
}
