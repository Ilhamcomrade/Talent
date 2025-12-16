<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Campus;

class CampusPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $campus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetUrl, $campus = null)
    {
        $this->resetUrl = $resetUrl;
        $this->campus = $campus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Kata Sandi Akun Kampus/Sekolah - InotalHub')
                    ->view('emails.campus_password_reset')
                    ->with([
                        'resetUrl' => $this->resetUrl,
                        'campuses' => $this->campus
                    ]);
    }
}
