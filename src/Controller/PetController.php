<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Api\ApiTemplate;

#[Route('/api')]
class PetController extends AbstractController
{
    public function __construct(private ApiTemplate $template)
    {
    }
    #[Route('/pet/{id}', name: 'app_pet')]
    public function index(): Response
    {
         return $this->json([
            'pet' => 'test'
         ]);
    }
}
