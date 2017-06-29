<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['content'];
    public $timestamps = false;

    public function checkTag($content){
        return DB::table('tags')
            ->where('content', '=', $content)
            ->get();
    }

    public function insertGetId($content){
        return DB::table('tags')
            ->insertGetId([
                'content' => $content
            ]);
    }

    public function getTagOfProductId($pro_id)
    {
        return DB::table('tags')
            ->join('product_tag', 'tags.id', '=', 'product_tag.tag_id')
            ->where('product_id', '=', $pro_id)
            ->selectRaw('product_tag.*, tags.content as tag_name')
            ->get();
    }
}
