<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['name', 'subject', 'email', 'detail', 'readed'];

    public function getAllContact()
    {
        return DB::table('contacts')
            ->orderBy('readed', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->where('shop_id', '=', null)
            ->selectRaw('contacts.*')
            ->paginate(10);
    }

    public function getContactOfShop($shop_id)
    {
        return DB::table('contacts')
            ->where('shop_id', '=', $shop_id)
            ->orderBy('readed', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->selectRaw('contacts.*')
            ->paginate(10);
    }
}
