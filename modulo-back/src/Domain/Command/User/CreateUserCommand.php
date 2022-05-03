<?php

namespace App\Domain\Command\User;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserCommand
{
    /**
     * @Assert\Regex(pattern="/^[0-9]{9}$/", message="Invalid member number")
     */
    private ?string $uuid;

    /**
     * @Assert\Email()
     */
    private ?string $email;

    /**
     * @Assert\NotBlank()
     */
    private ?string $firstName;

    /**
     * @Assert\NotBlank()
     */
    private ?string $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Choice({"H", "F"})
     */
    private ?string $genre;

    /**
     * @Assert\Length(min=6, minMessage="Your password should be at least {{ limit }} characters")
     */
    private ?string $password;

    private bool $admin = false;

    public function __construct(
        string $uuid = null,
        string $email = null,
        string $firstName = null,
        string $lastName = null,
        string $genre = null,
        string $password = null,
        bool $admin = false,
    )
    {
        $this->uuid = $uuid;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->genre = $genre;
        $this->password = $password;
        $this->admin = $admin;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): CreateUserCommand
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function setIsAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
