<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataTransaction;
    public function __construct($transaction)
    {
        $this->dataTransaction = $transaction;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thông tin về giao dịch với khách hàng')
                    ->view('transaction')->with('data', $this->dataTransaction);
    }
}
