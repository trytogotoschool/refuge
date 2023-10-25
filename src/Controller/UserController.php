<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\DTO\CreateUserDto;
use App\DTO\UpdateUserPasswordDto;

use Doctrine\ORM\EntityManagerInterface;
use  App\Api\ApiTemplate;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api')]
class UserController extends AbstractController
{
    public function __construct(private ApiTemplate $template)
    {  
    }

    #[Route('/users', name: 'get_users',  methods:['GET'])]
    public function getUsers(EntityManagerInterface $em): Response
    {
        $users = $em->getRepository(User::class)->findAll();
        return $this->json($this->template->getSuccessTemplate($users), 200);
    }

    #[Route('/users/{id}', name: 'get_user',  methods:['GET'])]
    public function getOneUser(User $user): Response
    {
        return $this->json($this->template->getSuccessTemplate($user), 200);
    }

    #[Route('/users', name: 'create_user',  methods:['POST'])]
    public function createUser(#[MapRequestPayload] CreateUserDto $createUserDto, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {

        $user = new User();
        $user->setName($createUserDto->name);
        $user->setEmail($createUserDto->email);
        $pwd = $createUserDto->password;
        $hashedPwd = $passwordHasher->hashPassword($user, $pwd);
        $user->setActivated(false); 
        $user->setPassword($hashedPwd);
        $em->persist($user);
        $em->flush();

        return $this->json($this->template->getSuccessTemplate(), 200);
    }

    #[Route('/users/{id}', name: 'delete_user',  methods:['DELETE'])]
    public function deleteUser(User $user, EntityManagerInterface $em ): Response
    {
        $em->remove($user);
        $em->flush(); 
        return $this->json($this->template->getSuccessTemplate(), 200);
    }

    #[Route('/users/{id}/password', name: 'update_user_password',  methods:['PATCH'])]
    public function updatePassword(#[MapRequestPayload] UpdateUserPasswordDto $updateUserPasswordDto, User $user, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        
        if (!$passwordHasher->isPasswordValid($user, $updateUserPasswordDto->oldPassword)) {
            return $this->json($this->template->getFailTemplate(ApiTemplate::CURRENT_PASSWORD_FAIL, 500));
        } elseif ($updateUserPasswordDto->newPassword !== $updateUserPasswordDto->confirmNewPassword) {
            return $this->json($this->template->getFailTemplate(ApiTemplate::CONFIRM_NEW_PASSWORD_DIFFERENT, 500));
        } elseif ($passwordHasher->isPasswordValid($user, $updateUserPasswordDto->newPassword)) {
            return $this->json($this->template->getFailTemplate(ApiTemplate::NEW_PASSWORD_MUST_BE_DIFFERENT, 500));
        }
        
        $hashedPwd = $passwordHasher->hashPassword($user, $updateUserPasswordDto->newPassword);
        $user->setPassword($hashedPwd);
        $em->flush();         
        return $this->json($this->template->getSuccessTemplate(), 200);
    }
    


}
