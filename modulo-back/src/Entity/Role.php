<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 10)]
    private string $code;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $feminineName = null;

    #[ORM\ManyToOne(targetEntity: AgeSection::class)]
    private AgeSection $ageSection;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $icon;

    #[Pure] public function __construct(string $name, string $code, AgeSection $ageSection, ?string $feminineName = null)
    {
        $this->name = $name;
        $this->code = $code;
        $this->feminineName = $feminineName;
        $this->ageSection = $ageSection;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getFeminineName(): ?string
    {
        return $this->feminineName;
    }

    public function setFeminineName(?string $feminineName): self
    {
        $this->feminineName = $feminineName;

        return $this;
    }

    public function getAgeSection(): AgeSection
    {
        return $this->ageSection;
    }

    public function setAgeSection(AgeSection $ageSection): self
    {
        $this->ageSection = $ageSection;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
