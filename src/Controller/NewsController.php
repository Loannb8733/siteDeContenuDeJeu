<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\CommentType;
use App\Form\CategoryType;
use App\Repository\CommentRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class NewsController
 * @package App\Controller
 * @Route("/admin/news")
 */
class NewsController extends AbstractController
{
    
    /**
     * @Route("/", name="news")
     */
    public function index(NewsRepository $repo, CommentRepository $repobis)
    {
        $title = "Actualités";
        $news = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('news/news.html.twig', [
            'controller_name' => 'NewsController',
            'news' => $news,
            'title' => $title
        ]);
    }

    /**
     * @Route("/new", name="news_create")
     */
    public function formCreate(News $article = null, Request $request, EntityManagerInterface $manager) {
        $title = "Création d'un nouvel article";

        if (!$article) {
            $article = new News();
        }

        $form = $this->createForm(NewsType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('news_show', ['id' => $article->getId()]);
        }

        return $this->render('news/createNews.html.twig',  [
            'title' => $title,
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() != null,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_edit")
     */
    public function formUpdate(News $article = null, Request $request, EntityManagerInterface $manager) {
        $title = "Modification d'un nouvel article";

        $form = $this->createForm(NewsType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {           

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('news_show', ['id' => $article->getId()]);
        }

        return $this->render('news/editNews.html.twig',  [
            'title' => $title,
            'formUpdateArticle' => $form->createView(),
            'news' => $article,
        ]);
    }


    /**
     * @Route("/{id}", name="news_show")
     */
    public function show(News $news, Request $request, EntityManagerInterface $manager) {
        $titleComment = "Commentaires : ";
        $titleAddComment = "Ajouter un commentaire : ";

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setNews($news);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('news_show', ['id' => $news->getId()]);
        }
        //$repo = $this->getDoctrine()->getRepository(News::class);
        //$news = $repo->find($id);



        return $this->render('news/show.html.twig', [
            'titleComment' => $titleComment,
            'titleAddComment' => $titleAddComment,
            'news' => $news,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="news_delete")
     */
    public function delete(News $news, EntityManagerInterface $manager) {
        //$news = $this->getDoctrine()->getRepository(News::class)->find($id);
        
        $manager->remove($news);
        $manager->flush();

        return $this->redirectToRoute('news');
    }
}
