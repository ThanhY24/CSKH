<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $imageName;
    public function __construct($name)
    {
        $this->imageName = $name;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $imagePath = public_path('images/' . $this->imageName);

        return $this->subject('VNPT gửi báo giá sản phẩm')
                    ->view('quotation', ['imageName' => $this->imageName])
                    ->attach($imagePath, [
                        'as' => $this->imageName,
                    ]);
    }

}
