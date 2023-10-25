<?php 
namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDto
 {
     public function __construct(
         #[Assert\NotBlank]
         #[Assert\Length(min: 3, max: 30)]
         public readonly string $name,

         #[Assert\Email()]
         #[Assert\Length(min: 3, max: 30)]
         public readonly string $email,


         #[Assert\Length(min: 8)]
         public readonly string $password,
         
        
         public readonly string $label = "User"
 
     ) {
      }
 }