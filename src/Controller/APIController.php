<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api", name="api")
 */
class APIController extends AbstractController
{
    /**
     * @Route("/register", name="api_register")
     */

    public function register(HttpFoundationRequest $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $newUser = new User();

        
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        
        $password = $passwordEncoder->encodePassword($newUser, $password);
        
        $newUser->setEmail($email);
        $newUser->setPassword($password);
        $newUser->setRoles(['ROLE_SALES']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($newUser);
        $entityManager->flush();

        return new JsonResponse(
            ['status' => "success",
            'message' => "user created successflly"]
            );
    }
}
