<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationRejected extends Mailable
{
    use Queueable, SerializesModels;

    protected $userData;

    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    public function build()
    {
        return $this->subject('Yêu cầu đăng ký tài khoản đã bị từ chối')
                    ->view('emails.registration-rejected')
                    ->with([
                        'userData' => $this->userData
                    ]);
    }
} 