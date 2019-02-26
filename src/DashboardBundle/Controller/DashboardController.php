<?php

namespace DashboardBundle\Controller;

use NoteBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Freelancer;


class DashboardController extends Controller

{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function freelancerDashboardAction()
    {
        return $this->render('DashboardBundle:Freelancer:dashboard.html.twig');
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function employerDashboardAction()
    {
        return $this->render('DashboardBundle:Employer:dashboard.html.twig');
    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function newAction(Request $request)
    {
        //parameters from request
        $noteText = $request->get('note');
        $priorityText = $request->get('priority');

        //if fields empty
        if ($priorityText == '' && $noteText == '') {
            return new JsonResponse(["message" => 'Pirority and Note are required', "validate" => false]);
        }
        if ($priorityText == '') {
            return new JsonResponse(["message" => 'Priority is required', "validate" => false]);
        } else if ($noteText == '') {
            return new JsonResponse(["message" => 'Note is required', "validate" => false]);
        } else if ($request->isXmlHttpRequest()) {
            //fields filled and request made
            $note = new Note();
            $note->setNoteText($noteText);
            $note->setPriority($priorityText);


            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            $url = $this->generateUrl('freelancer_dashboard');

            return new JsonResponse(["message" => 'Note added :)', "validate" => true, "redirect" => $url]);
        }
    }


        /**
         * @Security("has_role('ROLE_EMPLOYER')")
         */

        public function delete_self_noteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $self_note=$em->getRepository(Note::class)->find($id);
        $em->remove($self_note);
        $em->flush();
        return $this->render('NoteBundle:Freelancer::self_notes_list.html.twig');

    }

}
