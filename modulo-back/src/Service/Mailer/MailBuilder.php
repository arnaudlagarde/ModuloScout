<?php

namespace App\Service\Mailer;

use App\Enum\RecipientTypeEnum;
use App\Exception\Mailer\MailException;
use App\Model\Mail\MailAbstract;
use Psr\Log\LoggerInterface;
use Twig\Environment;
use Throwable;
use Symfony\Component\Mime\Email;

class MailBuilder
{
    public function __construct(private LoggerInterface $logger, private Environment $twigEnvironment, private string $mailSender)
    {
    }

    /**
     * @throws MailException
     */
    public function build(MailAbstract $mail): Email
    {
        $parameters = $mail->getTemplateParameters();

        try {
            $template = $this->twigEnvironment->load($mail->getTemplate());
            $subject = $template->renderBlock('subject', $parameters);
            $html = $template->renderBlock('html', $parameters);
            $text = $template->renderBlock('text', $parameters);
        } catch (Throwable $exception) {
            $this->logger->error(sprintf(
                'Failed building email (%s at line %u in %s)',
                $exception->getMessage(),
                $exception->getLine(),
                $exception->getFile()
            ));

           throw new MailException('Could not build mail', 0, $exception);
        }

        $finalMail = (new Email())
            ->from($mail->getSender() ?? $this->mailSender)
            ->subject($subject)
            ->text($text)
            ->html($html)
        ;

        foreach ($mail->getRecipients() as $recipient) {
            match ($recipient->getType()) {
                RecipientTypeEnum::MAIN => $finalMail->to($recipient->toMimeAddress()),
                RecipientTypeEnum::CARBON_COPY => $finalMail->addCc($recipient->toMimeAddress()),
                RecipientTypeEnum::BLIND_CARBON_COPY => $finalMail->addBcc($recipient->toMimeAddress()),
            };
        }

        return $finalMail;
    }
}
