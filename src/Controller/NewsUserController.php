<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\News;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsUserController
 * @package App\Controller
 * @Route("/user/news")
 */
class NewsUserController extends AbstractController
{
    /**
     * @Route("/", name="news_user")
     */
    public function index(NewsRepository $repo)
    {
        $title = "Actualités";
        $news = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('news_user/newsUser.html.twig', [
            'news' => $news,
            'title' => $title
        ]);
    }

    /**
     * @Route("/{id}", name="news_user_show")
     */
    public function show(CommentRepository $repo, News $news, Request $request, EntityManagerInterface $manager) {
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

            return $this->redirectToRoute('news_user_show', ['id' => $news->getId()]);
        }

        //$repo = $this->getDoctrine()->getRepository(News::class);
        //$news = $repo->find($id);

        return $this->render('news_user/show.html.twig', [
            'titleComment' => $titleComment,
            'titleAddComment' => $titleAddComment,
            'news' => $news,
            'commentForm' => $form->createView()
        ]);
    }
}
