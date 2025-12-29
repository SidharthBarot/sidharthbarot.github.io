<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class UsersListMail extends Mailable
{
    use Queueable, SerializesModels;

    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.users', [
            'users' => $this->users
        ]);

        return $this->subject('Users List PDF')
            ->view('emails.userslist') // simple message
            ->attachData($pdf->output(), 'users.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
