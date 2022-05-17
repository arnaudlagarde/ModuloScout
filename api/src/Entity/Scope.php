<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ScopeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: ScopeRepository::class)]
#[ApiResource]
class Scope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Structure::class)]
    private Structure $structure;

    #[ORM\ManyToOne(targetEntity: Role::class)]
    private Role $role;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'invitedScope')]
    private $invitedTo;

    #[Pure] public function __construct(User $user, Structure $structure, Role $role)
    {
        $this->user = $user;
        $this->structure = $structure;
        $this->role = $role;
        $this->invitedTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getStructure(): Structure
    {
        return $this->structure;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getInvitedTo(): Collection
    {
        return $this->invitedTo;
    }

    public function addInvitedTo(Event $invitedTo): self
    {
        if (!$this->invitedTo->contains($invitedTo)) {
            $this->invitedTo[] = $invitedTo;
            $invitedTo->addInvitedScope($this);
        }

        return $this;
    }

    public function removeInvitedTo(Event $invitedTo): self
    {
        if ($this->invitedTo->removeElement($invitedTo)) {
            $invitedTo->removeInvitedScope($this);
        }

        return $this;
    }
}
