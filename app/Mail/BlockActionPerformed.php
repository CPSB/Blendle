<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class BlockActionPerformed
 *
 * @package App\Mail
 */
class BlockActionPerformed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The data from the block form in the system.
     *
     * @var mixed $input
     */
    public $input;

    /**
     * Create a new message instance.
     *
     * @param  mixed $input
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.blocked', $this->input)
            ->subject('Your account has been blocked.');
    }
}
