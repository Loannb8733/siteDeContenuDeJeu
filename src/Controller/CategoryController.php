<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\News;
use App\Form\CategoryType;
use App\Form\NewsType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route("/admin/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="category")
     */
    public function index(CategoryRepository $repo)
    {
        $title = "Catégorie";
        $category = $repo->findBy([], ['id' => 'DESC']);



        return $this->render('category/category.html.twig', [
            'category' => $category,
            'title' => $title
        ]);
    }

    /**
     * @Route("/new", name="category_create")
     */
    public function formCreate(Category $category = null, Request $request, EntityManagerInterface $manager) {
        $titleAddCategory = "Ajouter une catégorie : ";

        if (!$category) {
            $category = new Category();
        }

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $category->setTitle($category->getTitle())
                     ->setContent($category->getContent());

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('news_create');
        }

        return $this->render('category/createCategory.html.twig',  [
            'titleAddCategory' => $titleAddCategory,
            'categoryForm' => $categoryForm->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="category_delete")
     */
    public function delete(Category $category, EntityManagerInterface $manager) {
        //$news = $this->getDoctrine()->getRepository(News::class)->find($id);

        $manager->remove($category);
        $manager->flush();

        return $this->redirectToRoute('category');
    }
}
