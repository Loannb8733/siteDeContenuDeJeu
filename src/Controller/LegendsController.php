<?php

namespace App\Controller;

use App\Entity\Legends;
use App\Form\LegendsType;
use App\Repository\LegendsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class LegendsController
 * @package App\Controller
 * @Route("/admin/legends")
 */
class LegendsController extends AbstractController
{
    /**
     * @Route("/", name="legends")
     */
    public function index(LegendsRepository $repo)
    {
        $title = 'Légendes';
        $legends = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('legends/legends.html.twig', [
            'controller_name' => 'LegendsController',
            'legends' => $legends,
            'title' => $title
        ]);
    }

    /**
     * @Route("/new", name="legends_create")
     */
    public function formCreate(Legends $legends = null, Request $request, EntityManagerInterface $manager) {
        $title = "Création d'une nouvelle légende";

        if (!$legends) {
            $legends = new Legends();
        }

        $form = $this->createForm(LegendsType::class, $legends);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$legends->getId()) {
                $legends->setCreatedAt(new \DateTime());
            }

            $manager->persist($legends);
            $manager->flush();

            return $this->redirectToRoute('legends', ['id' => $legends->getId()]);
        }

        return $this->render('legends/createLegends.html.twig',  [
            'title' => $title,
            'formLegends' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="legends_edit")
     */
    public function formUpdate(Legends $legends = null, Request $request, EntityManagerInterface $manager) {
        $title = "Modification de la légende";

        $form = $this->createForm(LegendsType::class, $legends);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($legends);
            $manager->flush();

            return $this->redirectToRoute('legends', ['id' => $legends->getId()]);
        }

        return $this->render('legends/editLegends.html.twig',  [
            'title' => $title,
            'formLegends' => $form->createView(),
            'legends' => $legends
        ]);
    }

    /**
     * @Route("/delete/{id}", name="legends_delete")
     */
    public function delete(Legends $legends, EntityManagerInterface $manager) {
        $manager->remove($legends);
        $manager->flush();

        return $this->redirectToRoute('legends');
    }
}
