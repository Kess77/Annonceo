<?php

namespace App\Controller;

use App\Form\UtilisateurFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * @Route("/account/profile", name="account")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(UtilisateurFormType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();
        }

        return $this->render('account/index.html.twig', [
            'profile_form' => $form->createView()
        ]);
    }
}
