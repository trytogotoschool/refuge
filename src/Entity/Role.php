<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    use HasIdTrait;

    #[ORM\Column(length: 30, unique: true)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $updateBlog = null;

    #[ORM\Column]
    private ?bool $updatePet = null;

    #[ORM\Column]
    private ?bool $updateUser = null;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: User::class)]
    private Collection $usr;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->usr = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

 

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isUpdateBlog(): ?bool
    {
        return $this->updateBlog;
    }

    public function setUpdateBlog(bool $updateBlog): static
    {
        $this->updateBlog = $updateBlog;

        return $this;
    }

    public function isUpdatePet(): ?bool
    {
        return $this->updatePet;
    }

    public function setUpdatePet(bool $updatePet): static
    {
        $this->updatePet = $updatePet;

        return $this;
    }

    public function isUpdateUser(): ?bool
    {
        return $this->updateUser;
    }

    public function setUpdateUser(bool $updateUser): static
    {
        $this->updateUser = $updateUser;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsr(): Collection
    {
        return $this->usr;
    }

    public function addUsr(User $usr): static
    {
        if (!$this->usr->contains($usr)) {
            $this->usr->add($usr);
            $usr->setRole($this);
        }

        return $this;
    }

    public function removeUsr(User $usr): static
    {
        if ($this->usr->removeElement($usr)) {
            // set the owning side to null (unless already changed)
            if ($usr->getRole() === $this) {
                $usr->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRole() === $this) {
                $user->setRole(null);
            }
        }

        return $this;
    }
}
