<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\CreateUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Exception;
class RegistrationController extends AbstractController
{

    #[Route('/register', methods:['GET', 'POST'], name: 'register')]
    public function register(Request $request, CreateUser $createUser): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $user = $createUser->create($request);
                if(isset($user['errors'])){
                    return $this->json($user, 400);
                }
                return $this->json($user);
            } catch (Exception $ex){

                $this->addFlash('danger', $ex->getMessage());
            }
        }
        return $this->render('auth/register.html.twig');
    }


    #[Route('/login', methods:['GET', 'POST'], name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
}
