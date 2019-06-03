<?php

namespace App\Mail\Auth;

use App\Domain\User\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class VerifyMail
 * @package App\Mail\Auth
 * @property User $user
 */

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
       $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject('SignUp Confirmation')
            ->markdown('emails.auth.register.verify');
    }
}
