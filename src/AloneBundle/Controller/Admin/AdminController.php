<?php

namespace AloneBundle\Controller\Admin;

use AloneBundle\Entity\AdminUser;
use AloneBundle\Entity\Comment;
use AloneBundle\Entity\DevBlog;
use AloneBundle\Entity\Media;
use AloneBundle\Form\AddDevBlog_Form;
use AloneBundle\Form\AddMedia_Form;
use AloneBundle\Form\NewUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin")
 * Class AdminController
 * @package AloneBundle\Admin\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/start", name="adminStart")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Alone/Admin/admin_start.html.twig');
    }

    /**
     * @Route("/media_hinzufügen", name="addMedia")
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addMediaAction(Request $request)
    {

        $media = new Media();

        $form = $this->createForm(AddMedia_Form::class, $media);

        $form->handleRequest($request);

        if($form->isSubmitted()){


            $this->addFlash('info', 'Form logik');
            $file = $media->getFile();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('media_directory'),
                $fileName
            );

            $media->setFile($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();

            return $this->redirectToRoute('adminStart');
        }

        return $this->render('@Alone/Admin/add_media.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/blog_hinzufügen", name="addDevBlog")
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addDevBlog(Request $request){

        $devBlog = new DevBlog();

        $form = $this->createForm(AddDevBlog_Form::class, $devBlog);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($devBlog);
            $em->flush();

            return $this->redirectToRoute('adminStart');
        }

        return $this->render('@Alone/Admin/add_devblog.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/user_hinzufügen", name="addUser")
     * @param Request $request
     * @return int
     */
    public function addUser(Request $request){

        $adminUser = new AdminUser();

        $form = $this->createForm(NewUserForm::class, $adminUser);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($adminUser);
            $em->flush();

            return $this->redirectToRoute('adminStart');

        }

        return $this->render('@Alone/Admin/add_user.html.twig', array('form' => $form->createView()));

    }

    /**
     * @Route("/kommentar/freigeben", name="enableComment")
     * @return int
     */
    public function enableComment(){

        $comments = $this->getDoctrine()->getManager()->getRepository('AloneBundle:Comment')->findBy(['enabled' => false]);

        return $this->render('@Alone/Admin/enable_comment.html.twig', array('comments' => $comments));
    }

    /**
     * @Route("/kommentar/freigeben/{comment}", name="seeComment")
     * @param Comment $comment
     * @return int
     */
    public function seeComment(Comment $comment){

        return $this->render('@Alone/Admin/show_comment.html.twig', array('comment' => $comment));
    }

    /**
     * @Route("/kommentar/freischalten/{comment}/{enabled}", name="commentEnabled")
     * @param Comment $comment
     * @param $enabled
     * @return int
     */
    public function commentEnabled(Comment $comment, $enabled)
    {

    $em = $this->getDoctrine()->getManager();

    if ($enabled == true) {
            $comment->setEnabled(true);

        $em->persist($comment);
        $em->flush();
    } else {
        $em->remove($comment);
        $em->flush();
    }

        return $this->redirectToRoute('enableComment');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(){
        return $this->redirectToRoute('adminStart');
    }

}
