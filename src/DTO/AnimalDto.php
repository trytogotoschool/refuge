<?php 
namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class AnimalDto
 {
     public function __construct(
         #[Assert\NotBlank]
         #[Assert\Length(min: 3, max: 30)]
         public readonly string $name,

 
     ) {
     }
 }