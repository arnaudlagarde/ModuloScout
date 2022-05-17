<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'datetime_immutable')]
    private $startedAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $endedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'events')]
    private $author;

    #[ORM\ManyToMany(targetEntity: Scope::class, inversedBy: 'invitedTo')]
    private $invitedScope;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'invitedTo')]
    private $invitedUser;

    #[ORM\ManyToMany(targetEntity: EventCategory::class, inversedBy: 'events')]
    private $eventLinkCategory;

    public function __construct()
    {
        $this->invitedScope = new ArrayCollection();
        $this->invitedUser = new ArrayCollection();
        $this->eventLinkCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(\DateTimeImmutable $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Scope>
     */
    public function getInvitedScope(): Collection
    {
        return $this->invitedScope;
    }

    public function addInvitedScope(Scope $invitedScope): self
    {
        if (!$this->invitedScope->contains($invitedScope)) {
            $this->invitedScope[] = $invitedScope;
        }

        return $this;
    }

    public function removeInvitedScope(Scope $invitedScope): self
    {
        $this->invitedScope->removeElement($invitedScope);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getInvitedUser(): Collection
    {
        return $this->invitedUser;
    }

    public function addInvitedUser(User $invitedUser): self
    {
        if (!$this->invitedUser->contains($invitedUser)) {
            $this->invitedUser[] = $invitedUser;
        }

        return $this;
    }

    public function removeInvitedUser(User $invitedUser): self
    {
        $this->invitedUser->removeElement($invitedUser);

        return $this;
    }

    /**
     * @return Collection<int, EventCategory>
     */
    public function getEventLinkCategory(): Collection
    {
        return $this->eventLinkCategory;
    }

    public function addEventLinkCategory(EventCategory $eventLinkCategory): self
    {
        if (!$this->eventLinkCategory->contains($eventLinkCategory)) {
            $this->eventLinkCategory[] = $eventLinkCategory;
        }

        return $this;
    }

    public function removeEventLinkCategory(EventCategory $eventLinkCategory): self
    {
        $this->eventLinkCategory->removeElement($eventLinkCategory);

        return $this;
    }
}
