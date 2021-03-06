<?php

namespace ProjectBundle\Controller;

use BidBundle\Entity\Bid;
use BidBundle\Form\BidType;
use ProjectBundle\Entity\Project;
use ProjectBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;


class ProjectController extends Controller
{

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function projectCreateAction(Request $request)
    {
        $project = new Project();
        $project->setProjectStartDay(new \DateTime('now'));

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ProjectType::class,$project);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('list_manage_projects');
        }
        return $this->render('@Project/Employer/post_project.html.twig',['form'=>$form->createView()]);

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function manage_projectAction()
    {
        $manage_project= $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('@Project/Employer/manage_project.html.twig', array('manage_project'=>$manage_project));

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function manage_projectsAction(Request $request)
    {
        $manage_projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $manage_projects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)/*limit per page*/
        );
        return $this->render('@Project/Employer/manage_projects.html.twig',["manage_projects" => $result]);

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function delete_manage_projectsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $manage_project=$em->getRepository(Project::class)->find($id);
        $em->remove($manage_project);
        $em->flush();
        return $this->redirectToRoute('list_manage_projects');

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    public function update_manage_projectsAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $manage_projects=$em->getRepository(Project::class)->find($id);
        $form = $this->createForm(ProjectType::class,$manage_projects);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($manage_projects);
            $em->flush();
            return $this->redirect($this->generateUrl('list_manage_projects'));
        }
        return $this->render('@Project/Employer/post_project.html.twig',['form'=>$form->createView()]);
    }




    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectAction()
    {
        return $this->render('@Project/Freelancer/singletask.html.twig');

    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectsAction(Request $request)
    {
        $projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $projects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)/*limit per page*/
        );
        return $this->render('@Project/Freelancer/tasks.html.twig',["projects" => $result]);

    }



    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectsListAction()
    {
        $projects= $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('@Project/Freelancer/taskslist.html.twig',["projects" => $projects]);

    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function singleProjectAction(Request $request,Project $project)
    {

        $em=$this->getDoctrine()->getManager();
        $bid = new Bid();
        $form=$this->createForm(BidType::class,$bid);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $bid->setProject($project);
            $em->persist($bid);
            $em->flush();
            return $this->redirectToRoute('freelancer_projects');
        }

        return $this->render('@Project/Freelancer/singletask.html.twig',["project" => $project,"form"=>$form->createView()]);

    }

























}
