<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
class MentorController extends AbstractController
{
    #[Route('/mentor', name: 'app_mentor')]
    public function index(): Response
    {
      
       
       
        
        return $this->render('mentor/index.html.twig', [
            'controller_name' => 'MentorController',
        ]);
    }
}
