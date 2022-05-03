<?php

namespace App\Domain\Command\User;

use App\Entity\User;
use App\Exception\Mailer\MailException;
use App\Mail\User\NewAccountMail;
use App\Service\Mailer\Mailer;
use App\Service\User\PasswordGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserHandler implements MessageHandlerInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
        private PasswordGenerator $passwordGenerator,
        private Mailer $mailer
    ) {
    }

    /**
     * @throws MailException
     */
    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User($command->getUuid(), $command->getEmail(), $command->getFirstName(), $command->getLastName(), $command->getGenre());
        $password = $command->getPassword() ?: $this->passwordGenerator->generate();
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $password));
        if ($command->isAdmin()) {
            $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->mailer->sendMail(new NewAccountMail($user, $password));
    }
}
