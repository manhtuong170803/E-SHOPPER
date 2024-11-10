<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

     //private $data = [];

    public $orderData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     //public function __construct($data)
    public function __construct($orderData)
    {
         //$this->data = $data;
        $this->orderData = $orderData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

     public function build()
     {

        // return $this->from('thienbaoit@gmail.com', 'test')
        //  ->subject($this->data['subject'])
        //  ->view('frontend.cart.mail')->with('data', $this->data);


        return $this->from('thienbaoit@gmail.com', 'Your Shop')
        ->subject('Thông tin đơn hàng của bạn')
        ->view('frontend.cart.mail')
        ->with('orderData', $this->orderData);
     }
 
//     public function envelope()
//     {
//         return new Envelope(
//             subject: 'Mail Notify',
//         );
//     }

//     /**
//      * Get the message content definition.
//      *
//      * @return \Illuminate\Mail\Mailables\Content
//      */
//     public function content()
//     {
//         return new Content(
//             view: 'view.name',
//         );
//     }

//     /**
//      * Get the attachments for the message.
//      *
//      * @return array
//      */
//     public function attachments()
//     {
//         return [];
//     }
}
