<?php
/**
 * Created by PhpStorm.
 * User: danileau
 * Date: 08.01.2019
 * Time: 20:50
 */

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(EntityManagerInterface $em) {
        $repository = $em->getRepository(Article::class);
        $articles =$repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show(Article $article)
    {

        $comments = $article->getComments();



        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();
        //TODO actually heart,unheart the article

        //Logeintrag erstellen
        $logger->info('Article has been hearted');

        return $this->json(['hearts' => $article->getHeartcount()]);
    }
};