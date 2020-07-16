<?php

namespace App\Controller\admin;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
