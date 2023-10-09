<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService extends TemplatedEmail
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        parent::__construct();
        $this->from($_ENV['MAILER_FROM']);
        $this->priority(Email::PRIORITY_HIGH);
    }

    public function setTemplate(string $template, array $vars): self
    {
        $this->htmlTemplate($template);
        $this->context($vars);
        return $this;
    }

    public function send(): bool
    {
        // test si le mail est bien envoyé
        try {
            $this->mailer->send($this);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}