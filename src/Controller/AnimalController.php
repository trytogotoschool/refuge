<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\DTO\AnimalDto;
use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use App\Api\ApiTemplate;

#[Route('/api')]
class AnimalController extends AbstractController
{

     public function __construct(private ApiTemplate $template)
    {
    }


    #[Route('/animals', name: 'get_animals', methods:['GET'])]
    public function getAnimal(EntityManagerInterface $em): Response
    {
        $animals = $em->getRepository(Animal::class)->findAll();
        $this->template->setData($animals);
        return $this->json($this->template->getTemplate(),  $this->template->getCode(),  $this->template->getHeaders());
    }

    #[Route('/animals/{id}', name: 'get_animal', methods:['GET'])]
    public function getAnimalById(Animal $animal): Response
    {
        return $this->json($this->template->getSuccessTemplate($animal), 200,  $this->template->getHeaders());
    }


    #[Route('/animals', name: 'add_animal', methods:['POST'])]
    public function newAnimal(#[MapRequestPayload] AnimalDto $animalDto,  EntityManagerInterface $em): Response
    {
        $animal = New Animal();
        $animal->setName($animalDto->name);
        $em->persist($animal);
        $em->flush();
        return $this->json($this->template->getSuccessTemplate(), 200, $this->template->getHeaders());
       
    }
    #[Route('/animals/{id}', name: 'delete_animal', methods:['DELETE'])]
    public function deleteAnimal(Animal $animal, EntityManagerInterface $em): Response
    {
        $em->remove($animal);
        $em->flush();
        $this->template->initSuccessTemplate();
        return $this->json($this->template->getTemplate(), 200);
    }


    #[Route('/animals/{id}', name: 'update_animal', methods:['PUT'])]
    public function updateAnimal(Animal $animal, #[MapRequestPayload] AnimalDto $animalDto, EntityManagerInterface $em): Response
    {
        if ($animal->getName() === $animalDto->name) {
            $this->template->setError(ApiTemplate::REQUIRED_DIFFERENT_NAME);
        } else {
            $animal->setName($animalDto->name);
            $em->flush();
            $this->template->initSuccessTemplate();
        }
        return $this->json($this->template->getTemplate(), $this->template->getCode());
       
    }
}
