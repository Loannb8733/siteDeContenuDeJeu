<?php

namespace App\Controller;

use App\Entity\FunnyStuffs;
use App\Form\FunnyStuffsType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FunnyStuffsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class FunnyStuffsController
 * @package App\Controller
 * @Route("/admin/funny-stuff")
 */
class FunnyStuffsController extends AbstractController
{
    /**
     * @Route("/", name="funny_stuffs")
     */
    public function index(FunnyStuffsRepository $repo): Response
    {
        $title = 'Funny stuffs';
        $funnyStuffs = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('funny_stuffs/funnyStuffs.html.twig', [
            'controller_name' => 'FunnyStuffsController',
            'funnyStuffs' => $funnyStuffs,
            'title' => $title
        ]);
    }

    /**
     * @Route("/new", name="funny_stuffs_create")
     */
    public function formCreate(FunnyStuffs $funnyStuffs = null, Request $request, EntityManagerInterface $manager) {
        $title = "Création de nouvelles légendes";

        if (!$funnyStuffs) {
            $funnyStuffs = new FunnyStuffs();
        }

        $form = $this->createForm(FunnyStuffsType::class, $funnyStuffs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$funnyStuffs->getId()) {
                $funnyStuffs->setCreatedAt(new \DateTime());
            }

            $manager->persist($funnyStuffs);
            $manager->flush();

            return $this->redirectToRoute('funny_stuffs_show', ['id' => $funnyStuffs->getId()]);
        }

        return $this->render('funny_stuffs/createFunnyStuffs.html.twig',  [
            'title' => $title,
            'formFunnyStuffs' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="funny_stuffs_edit")
     */
    public function formUpdate(FunnyStuffs $funnyStuffs = null, Request $request, EntityManagerInterface $manager) {
        $title = "Modification de la légende";

        $form = $this->createForm(FunnyStuffsType::class, $funnyStuffs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($funnyStuffs);
            $manager->flush();

            return $this->redirectToRoute('funny_stuffs_show', ['id' => $funnyStuffs->getId()]);
        }

        return $this->render('funny_stuffs/editFunnyStuffs.html.twig',  [
            'title' => $title,
            'formFunnyStuffs' => $form->createView(),
            'funnyStuffs' => $funnyStuffs
        ]);
    }

    /**
     * @Route("/{id}", name="funny_stuffs_show")
     */
    public function show(FunnyStuffs $funnyStuffs) {
        return $this->render('funny_stuffs/show.html.twig', [
            'funnyStuffs' => $funnyStuffs
        ]);
    }

    /**
     * @Route("/delete/{id}", name="funny_stuffs_delete")
     */
    public function delete(FunnyStuffs $funnyStuffs, EntityManagerInterface $manager) {
        $manager->remove($funnyStuffs);
        $manager->flush();

        return $this->redirectToRoute('funny_stuffs');
    }
}
