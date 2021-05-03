<?php

namespace App\Mail\API;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserConfirmationRegistration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Konfirmasi Pendaftaran')->markdown('emails.user-confirmation-register')->with([
            'name' => $this->user->name,
            'password' => $this->user->password,
            'url' => route('verify-user', $this->user->id),
        ]);
    }
}
