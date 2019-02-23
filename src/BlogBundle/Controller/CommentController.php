<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\article;
use BlogBundle\Entity\comment;
use BlogBundle\Form\commentType;
use ReviewBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function ajoutAction(Request $request)
    {

        $comment = new comment();
        $form = $this->createForm( commentType::class, $comment);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $r = $em->getRepository(Review::class)->find(1);
            $comment->setReview($r);
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('blog_affiche'));
        }
        return $this->render('@Blog/Comment/comment.html.twig' , array('form'=> $form->createView()));
    }

    public function afficheAction()
    {
        $comment = $this->getDoctrine()->getRepository(comment::class)->findAll(); // pour faire select (finall)
        return $this->render('@Blog/Comment/affiche.html.twig', array('comment' => $comment));
    }
    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository(comment::class)->find($id);
        $em->remove($comm);
        $em->flush();
        return $this->redirect($this->generateUrl('blog_affiche'));
    }

    public function editAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(comment::class)->find($id);
        $form = $this->createForm( commentType::class, $comment);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $r = $em->getRepository(Review::class)->find(1);
            $comment->setReview($r);
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('blog_affiche'));
        }
        return $this->render('@Blog/Comment/comment.html.twig' , array('form'=> $form->createView()));
    }

    public function pageBlogAction()
    {
        return $this->render('@Blog/Page/pagesBlog.html.twig');
    }
    public function pageBlogPostAction()
    {
        return $this->render('@Blog/Page/pagesBlogPost.html.twig');
    }


}
