<?php

namespace NoteBundle\Controller;

use NoteBundle\Entity\Note;
use NoteBundle\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class NoteController extends Controller
{


    public function self_notes_listAction()
    {
        $self_notes_list= $this->getDoctrine()->getRepository(Note::class)->findAll();
        return $this->render('@Note/Freelancer/self_notes_list.html.twig',array('self_notes_list' => $self_notes_list));

    }

    public function create_self_noteAction(Request $request)
    {
        $note = new Note();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(NoteType::class,$note);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute('self_notes_list');
        }
        return $this->render('@Note/Freelancer/create_self_note.html.twig',['form'=>$form->createView()]);

    }


    public function delete_self_noteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $self_note=$em->getRepository(Note::class)->find($id);
        $em->remove($self_note);
        $em->flush();
        return $this->redirectToRoute('self_notes_list');

    }

    public function update_self_noteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $self_note=$em->getRepository(Note::class)->find($id);
        $form = $this->createForm(NoteType::class,$self_note);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($self_note);
            $em->flush();
            return $this->redirect($this->generateUrl('self_notes_list'));
        }
        return $this->render('@Note/Freelancer/create_self_note.html.twig',['form'=>$form->createView()]);
    }
}
