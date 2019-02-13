<?php
/**
 * Created by PhpStorm.
 * User: danileau
 * Date: 15.01.2019
 * Time: 16:56
 */

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em){
        die();
        return new Response(sprintf(
            'Hiya! New article id: #%d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));
    }
}