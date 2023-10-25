<?php
namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;


class RoleDto
{

    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 30)]
        public readonly string $name,

        public readonly bool $updatePet,
        public readonly bool $updateBlog,
        public readonly bool $updateUser



    ) {
    }
}