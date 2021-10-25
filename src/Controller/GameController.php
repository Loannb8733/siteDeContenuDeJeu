<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class GameController
 * @package App\Controller
 * @Route("/admin/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="game")
     */
    public function index(GameRepository $repo)
    {
        $titleGame = 'Nouvelles sorties';
        $game = $repo->findBy([], ['CreatedAt' => 'DESC']);

        return $this->render('game/game.html.twig', [
            'titleGame' => $titleGame,
            'gameR' => $game
        ]);
    }

    /**
     * @Route("/new", name="game_create")
     */
    public function formCreate(Game $game = null, Request $request, EntityManagerInterface $manager) {
        $titleGame = "Création d'un nouvau jeu";

        if (!$game) {
            $game = new Game();
        }

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$game->getId()) {
                $game->setCreatedAt(new \DateTime());
            }

            $manager->persist($game);
            $manager->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getId()]);
        }

        return $this->render('game/createGame.html.twig',  [
            'title' => $titleGame,
            'gameForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="game_edit")
     */
    public function formUpdate(Game $game = null, Request $request, EntityManagerInterface $manager) {
        $title = "Modification du jeu";

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($game);
            $manager->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getId()]);
        }

        return $this->render('game/editGame.html.twig',  [
            'title' => $title,
            'form' => $form->createView(),
            'game' => $game
        ]);
    }

    /**
     * @Route("/{id}", name="game_show")
     */
    public function show(Game $game) {
        return $this->render('game/show.html.twig', [
            'game' => $game
        ]);
    }

    /**
     * @Route("/delete/{id}", name="game_delete")
     */
    public function delete(Game $game, EntityManagerInterface $manager) {
        $manager->remove($game);
        $manager->flush();

        return $this->redirectToRoute('game');
    }
}
