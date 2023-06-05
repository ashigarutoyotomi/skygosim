<?php


namespace App\Mail\Sim;


use App\DTO\User\CreateUserData;
use App\Mail\UserCreatedMail;
use App\Models\Sim\SimOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PhysicalSimOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $address;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SimOrder $order)
    {
        $this->order = $order;
        $this->address = $order->address;
        $this->user = $order->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sim.physical-sim-order')
            ->subject("Phyical SIM purchase");
    }
}
