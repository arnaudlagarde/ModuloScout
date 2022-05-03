<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if (null !== $error) {
            $this->addFlash('error', $error->getMessage());
        }

        // last username entered by the user
        $lastUuid = $authenticationUtils->getLastUsername();

        return $this->render('login/form.html.twig', [
            'last_uuid' => $lastUuid,
        ]);
    }
}
