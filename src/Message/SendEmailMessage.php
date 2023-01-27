<?php

namespace App\Message;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

final class SendEmailMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */
    private MailerInterface $mailer;
    private string $senderEmail;
    private string $senderName;

    /**
     * @param MailerInterface $mailer
     * @param string $senderEmail
     * @param string $senderName
     */
    public function __construct(MailerInterface $mailer, string $senderEmail, string $senderName)
    {
        $this->mailer = $mailer;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
    }

    /**
     * @return MailerInterface
     */
    public function getMailer(): MailerInterface
    {
        return $this->mailer;
    }

    /**
     * @param MailerInterface $mailer
     */
    public function setMailer(MailerInterface $mailer): void
    {
        $this->mailer = $mailer;
    }

    /**
     * @return string
     */
    public function getSenderEmail(): string
    {
        return $this->senderEmail;
    }

    /**
     * @param string $senderEmail
     */
    public function setSenderEmail(string $senderEmail): void
    {
        $this->senderEmail = $senderEmail;
    }

    /**
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->senderName;
    }

    /**
     * @param string $senderName
     */
    public function setSenderName(string $senderName): void
    {
        $this->senderName = $senderName;
    }

    /**
     * @param array<mixed> $arguments
     * @return void
     */
    public function send(array $arguments): void{
        [
            'recipient_email' => $recipientEmail,
            'subject' => $subject,
            'html_template' => $html_template,
            'context' => $context
        ]=$arguments;

        $email = new TemplatedEmail();

        $email->from(new Address($this->senderEmail,$this->senderName))
                ->to($recipientEmail)
                ->subject($subject)
                ->htmlTemplate($html_template)
                ->context($context);
        try {
            $this->mailer->send($email);
        }catch (TransportExceptionInterface $transportException){
            throw $transportException;
        }
    }

}
