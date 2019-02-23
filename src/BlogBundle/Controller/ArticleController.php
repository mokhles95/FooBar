<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function addAction()
    {
        return $this->render('@Blog/Article/ajoutArticle.html.twig');
    }

    public function showAction()
    {
        return $this->render('@Blog/Article/showArticle.html.twig');
    }

    public function listAction()
    {
        return $this->render('@Blog/Article/blogArticle.html.twig');
    }


}
