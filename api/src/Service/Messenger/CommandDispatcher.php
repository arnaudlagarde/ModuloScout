<?php

namespace App\Service\Messenger;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Exception\InvalidCommandException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

class CommandDispatcher
{
    public function __construct(
        private LoggerInterface $logger,
        private MessageBusInterface $messageBus,
        private ValidatorInterface  $validator,
        private TranslatorInterface $translator
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function dispatch(object $command): Envelope
    {
        try {
            $this->validator->validate($command);
        } catch (ValidationException $exception) {
            $violation = $exception->getConstraintViolationList()->get(0);

            throw new InvalidCommandException(
                $this->translator->trans(
                    'Command data is invalid for attribute %attribute% (%message%)',
                    [
                        '%attribute%' => $violation->getPropertyPath(),
                        '%message%' => $violation->getMessage(),
                    ],
                    'validator',
                )
            );
        }

        try {
            return $this->messageBus->dispatch($command);
        } catch (HandlerFailedException $exception) {
            $this->logger->error(sprintf(
                'Failed handling command (%s at line %u in %s)',
                $exception->getMessage(),
                $exception->getLine(),
                $exception->getFile()
            ));

            while ($exception instanceof HandlerFailedException) {
                /** @var Throwable $exception */
                $exception = $exception->getPrevious();
            }

            throw $exception;
        }
    }
}
