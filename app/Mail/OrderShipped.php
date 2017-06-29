<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($objBill, $objProduct, $objShop, $header)
    {
        $this->objBill = $objBill;
        $this->objProduct = $objProduct;
        $this->title = $objShop->name;
        $this->objShop = $objShop;
        $this->header = $header;
    }

    public function build()
    {
        return $this->from('hquangthien1@gmail.com', 'E-shopper')
            ->to($this->objBill->email, $this->objBill->name)
            ->subject('Đặt hàng thành công')
            ->markdown('emails.orders.shipped')
            ->with('objBill', $this->objBill)
            ->with('objProduct', $this->objProduct)
            ->with('title', $this->title)
            ->with('header', $this->header)
            ->with('objShop', $this->objShop);
    }
}
