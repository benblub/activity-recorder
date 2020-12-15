<?php
namespace App\Service\Mailer;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationEmail
{
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(User $user)
    {
        $email = (new TemplatedEmail())
            ->from('donotreply@activiy-recorder.com')
            ->to($user->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Activate your ActivityRecorder Account')
            //->text('activate your Account, http://localhost:8000/api/user/activate/12345')
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'user' => $user
            ]);

        $this->mailer->send($email);

        return $email;
    }
}