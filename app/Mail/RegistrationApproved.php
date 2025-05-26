<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationApproved extends Mailable
{
    use Queueable, SerializesModels;

    protected $userData;

    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    public function build()
    {
        return $this->subject('Yêu cầu đăng ký tài khoản đã được phê duyệt')
                    ->view('emails.registration-approved')
                    ->with([
                        'userData' => $this->userData
                    ]);
    }
} 