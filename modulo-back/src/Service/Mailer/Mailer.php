<?php

namespace App\Service\Mailer;

use App\Exception\Mailer\MailException;
use App\Model\Mail\MailAbstract;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class Mailer
{
    public function __construct(private MailerInterface $mailer, private MailBuilder $builder)
    {
    }

    /**
     * @throws MailException
     */
    public function sendMail(MailAbstract $mail): void
    {
        try {
            $this->mailer->send($this->builder->build($mail));
        } catch (TransportExceptionInterface $exception) {
            throw new MailException('Failed sending email', 0, $exception);
        }
    }
}
