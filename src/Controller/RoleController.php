<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;
use App\DTO\RoleDto;
use Doctrine\ORM\EntityManagerInterface;
use  App\Api\ApiTemplate;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/api')]
class RoleController extends AbstractController
{
    public function __construct(private ApiTemplate $template)
    {  
    }

    #[Route('/roles', name: 'get_roles', methods:['GET'])]
    public function getRoles(EntityManagerInterface $em) : Response
    {
        $roles = $em->getRepository(Role::class)->findAll();
        return $this->json($this->template->getSuccessTemplate($roles), 200, $this->template->getHeaders());
    }

    #[Route('/roles/{id}', name: 'get_role', methods:['GET'])]
    public function getRole(Role $role): Response
    {
       
        $role ? $this->template->setData($role) : $this->template->setError(ApiTemplate::NOT_FOUND);
        return $this->json($this->template->getTemplate(), 200, $this->template->getHeaders());

    }

    #[Route('/roles', name: 'add_role', methods:['POST'])]
    public function addRole(#[MapRequestPayload] RoleDto $roleDto, EntityManagerInterface $em): Response
    {

        $role = new Role();
        $role->setName($roleDto->name)->setUpdateBlog($roleDto->updateBlog)->setUpdatePet($roleDto->updatePet)->setUpdateUser($roleDto->updateUser);
        $em->persist($role);
        $em->flush();


        return $this->json($this->template->getSuccessTemplate(), 200, $this->template->getHeaders());
    }
    
    #[Route('/roles/{id}', name: 'update_role', methods:['PUT'])]
    public function updateRole(Role $role, #[MapRequestPayload] RoleDto $roleDto, EntityManagerInterface $em): Response
    {
        if ($role->getName() === $roleDto->name) {
            $this->template->setError(ApiTemplate::REQUIRED_DIFFERENT_NAME);
        } else {
            $role->setName($roleDto->name)->setUpdateBlog($roleDto->updateBlog)->setUpdatePet($roleDto->updatePet)->setUpdateUser($roleDto->updateUser);
            $em->flush();
            $this->template->initSuccessTemplate();
        }
        return $this->json($this->template->getTemplate(), $this->template->getCode());
    }

    #[Route('/roles/{id}', name: 'delete_role', methods:['DELETE'])]
    public function deleteRole(Role $role, EntityManagerInterface $em): Response
    {
       $em->remove($role);
       $em->flush(); 
       return $this->json($this->template->getSuccessTemplate(), 200);

    }
}
