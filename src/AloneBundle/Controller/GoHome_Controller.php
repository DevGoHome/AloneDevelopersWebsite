<?php

namespace AloneBundle\Controller;

use AloneBundle\Entity\Comment;
use AloneBundle\Entity\DevBlog;
use AloneBundle\Form\Comment_Form;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Tests\Data\Provider\Json\JsonRegionDataProviderTest;

class GoHome_Controller extends Controller
{

    /**
     * @Route("GoHome/start", name="GoHome_start")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function startAction()
    {
        return $this->render('@Alone/GoHome/go_home_start.html.twig');
    }

    /**
     * @Route("GoHome/dev_blog", name="GoHome_devBlog")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function devBlogAction()
    {

        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('AloneBundle:DevBlog')->findAll();

        return $this->render('@Alone/GoHome/dev_blog.html.twig', array('blogs' => $blogs));
    }

    /**
     * @Route("GoHome/getBlogs", name="GoHome_pagedBlogs")
     * @param $page
     * @param $count
     * @return JsonResponse
     */
    public function getPagedBlogs($page, $count){

        $blogs = $this->getDoctrine()->getRepository('AloneBundle:DevBlog')->findAll();

        $result = array();

        foreach ($blogs as $blog) {
            array_push($result, $blog);
        }

        return new JsonResponse(['data' => $result], 'success');
    }

    /**
     * @Route("GoHome/dev_blog/{id}", name="GoHome_show_devBlog")
     * @param DevBlog $blog
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showDevBlogAction(DevBlog $blog, Request $request)
    {

        $comment = new Comment();

        $em = $this->getDoctrine()->getManager();
        $prev = $em->getRepository('AloneBundle:DevBlog')->previous($blog);
        $next = $em->getRepository('AloneBundle:DevBlog')->next($blog);

        $form = $this->createForm(Comment_Form::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $comment->setBlog($blog);
            $em->persist($comment);
            $em->flush();

            unset($comment);

            return $this->redirectToRoute('GoHome_show_devBlog', array('id' => $blog->getId()));
        }

        $comments = $em->getRepository('AloneBundle:Comment')->findBy(['blog' => $blog]);

        return $this->render(
            '@Alone/GoHome/show_dev_blog.html.twig',
            array(
                  'blog' => $blog, 'prev' => $prev, 'next' => $next,
                  'form' => $form->createView(), 'comments' => $comments,
            ));
    }

    /**
     * @Route("GoHome/About", name="GoHome_About")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function goHomeAboutAction()
    {
        return $this->render('@Alone/GoHome/go_home_about.html.twig');
    }

    /**
     * @Route("GoHome/Media", name="GoHome_Media")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function goHomeMediaAction()
    {

        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('AloneBundle:Media')->findAll();
        
        return $this->render('@Alone/GoHome/go_home_media.html.twig', array('media' => $media));
    }

    /**
     * @Route("GoHome/Media/Information", name="Information")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function goHomeInformationAction()
    {
        return $this->render('@Alone/GoHome/information.html.twig');
    }

}
