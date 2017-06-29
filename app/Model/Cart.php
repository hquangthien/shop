<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id){
        if($item->promotion_price == 0){
            $giohang = ['qty'=>0, 'price' => $item->price, 'item' => $item];
        }
        else{
            $giohang = ['qty'=>0, 'price' => ($item->price - (($item->price * $item->promotion_price)/100)), 'item' => $item];
        }
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $giohang = $this->items[$id];
            }
        }
        $giohang['qty']++;
        if($item->promotion_price == 0){
            $giohang['price'] = $item->price * $giohang['qty'];
        }
        else{
            $giohang['price'] = ($item->price - (($item->price * $item->promotion_price)/100)) * $giohang['qty'];
        }
        $this->items[$id] = $giohang;
        $this->totalQty++;
        if($item->promotion_price == 0){
            $this->totalPrice += $item->unit_price;
        }
        else{
            $this->totalPrice += $item->promotion_price;
        }

    }

    public function addWithQty($item, $id, $qty){
        if($item->promotion_price == 0){
            $giohang = ['qty'=>0, 'price' => $item->price, 'item' => $item];
        }
        else{
            $giohang = ['qty'=>0, 'price' => ($item->price - (($item->price * $item->promotion_price)/100)), 'item' => $item];
        }
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $giohang = $this->items[$id];
            }
        }
        $oldQty = $giohang['qty'];
        $giohang['qty']=$qty;
        if($item->promotion_price == 0){
            $giohang['price'] = $item->price * $giohang['qty'];
        }
        else{
            $giohang['price'] = ($item->price - (($item->price * $item->promotion_price)/100)) * $giohang['qty'];
        }
        $this->items[$id] = $giohang;
        $this->totalQty = $this->totalQty - $oldQty + $qty;
        if($item->promotion_price == 0){
            $this->totalPrice += $item->unit_price;
        }
        else{
            $this->totalPrice += $item->promotion_price;
        }

    }

    //xóa 1
    public function reduceByOne($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if($this->items[$id]['qty']<=0){
            unset($this->items[$id]);
        }
    }
    //xóa nhiều
    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
