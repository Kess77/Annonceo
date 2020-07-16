<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index()
    {
        return $this->render('admin_category/index.html.twig', [
            'controller_name' => 'AdminCategoryController',
        ]);
    }
}
