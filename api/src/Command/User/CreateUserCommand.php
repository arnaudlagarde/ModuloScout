<?php

namespace App\Command\User;

use App\Domain\Command\User\CreateUserCommand as CreateUserDomainCommand;
use App\Service\Messenger\CommandDispatcher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'app:user:create',
    description: 'Creates a new user.',
    hidden: false
)]
class CreateUserCommand extends Command
{
    public function __construct(private CommandDispatcher $messageDispatcher)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('firstName', InputArgument::REQUIRED, 'The first name.')
            ->addArgument('lastName', InputArgument::REQUIRED, 'The last name.')
            ->addArgument('genre', InputArgument::REQUIRED, 'The user genre (H/F).')
            ->addArgument('uuid', InputArgument::REQUIRED, 'The member number (9 digits).')
            ->addArgument('email', InputArgument::REQUIRED, 'The email address.')
            ->addOption('admin', 'a', InputOption::VALUE_NONE, 'User is admin.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $firstName */
        $firstName = $input->getArgument('firstName');

        /** @var string $lastName */
        $lastName = $input->getArgument('lastName');

        /** @var string $egrne */
        $genre = $input->getArgument('genre');

        /** @var string $uuid */
        $uuid = $input->getArgument('uuid');

        /** @var string $uuid */
        $email = $input->getArgument('email');
        
        $isAdmin = (bool) $input->getOption('admin');

        if (empty($uuid) || empty($email)) {
            $output->writeLn('<fg=red;>uuid and email options are mandatory.</>');
        }

        $output->writeln(sprintf(
            'Creating use with uuid = %s, email = %s%s',
            $uuid,
            $email,
            $isAdmin ? ' (admin)' : ''
        ));

        try {
            $this->messageDispatcher->dispatch(new CreateUserDomainCommand($uuid, $email, $firstName, $lastName, $genre, null, true));
        } catch (Throwable $exception) {
            $output->writeLn(sprintf(
                '<fg=red;>failed creating user : %s at line %u in %s.</>',
                $exception->getMessage(),
                $exception->getLine(),
                $exception->getFile(),
            ));

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
