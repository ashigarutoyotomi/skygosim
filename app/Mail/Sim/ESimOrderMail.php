<?php


namespace App\Mail\Sim;


use App\Models\Sim\Sim;
use App\Models\Sim\SimOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ESimOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $downloadURL = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SimOrder $order)
    {
        $this->order = $order;
        $this->user = $order->user;

        if ($order->sim_type === SimOrder::SIM_TYPE_E_SIM) {
            $esim = Sim::find($order->sim_id);
            $this->downloadURL = $esim->download_url;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sim.e-sim-order')
            ->subject("E-SIM purchase");
    }
}
