<?php 
namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class PetDto
 {
     public function __construct(
         #[Assert\NotBlank]
         #[Assert\Length(min: 3, max: 30)]
         public readonly string $name,

         #[Assert\NotBlank]
         #[Assert\Length(min: 0, max: 30)]
         public readonly int $age,


         #[Assert\NotBlank]
         #[Assert\Length(min: 1, max: 2)]
         public readonly int $gender,

         #[Assert\NotBlank]
         public readonly string $desc,

         #[Assert\DateTime]
        public readonly ?string $birth,

         #[Assert\Length(min: 3, max: 30)]
         public readonly ?string $newName,
         public readonly string $label = "Pet"
     ) {
     }
 }