<?php

namespace App\Controller\admin;

use App\Form\CategoryFormType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index(CategorieRepository $repo)
    {
        $categorie = $repo->findAll();
        return $this->render('admin_category/index.html.twig', [
            'categories' => $categorie
        ]);
    }
    /**
     * @Route("admin/category/new", name="add_category")
     */
    public function  add(Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(CategoryFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();

            $manager->persist($categorie);
            $manager->flush();


            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin_category/add.html.twig', [
            'form_category' => $form->createView()
        ]);
    }
}
