<?php 
namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserPasswordDto
 {
     public function __construct(
      

         #[Assert\Length(min: 8)]
         public readonly string $oldPassword,
         #[Assert\Length(min: 8)]
         public readonly string $newPassword,
         #[Assert\Length(min: 8)]
         public readonly string $confirmNewPassword,
        
  
     ) {
      }
 }