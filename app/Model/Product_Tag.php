<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product_Tag extends Model
{
    protected $table = 'product_tag';
    protected $fillable = ['product_id', 'tags_id'];
    public $timestamps = false;

    public function insertTags($data){
        return DB::table('product_tag')
            ->insert($data);
    }

    public function hotTags()
    {
        return DB::table('product_tag')
            ->join('tags', 'product_tag.tag_id', '=', 'tags.id')
            ->selectRaw('count(tag_id) as tags_number, tags.content, tag_id')
            ->orderBy('tags_number', 'DESC')
            ->groupBy('tags.content')
            ->groupBy('product_tag.tag_id')
            ->take(10)
            ->get();
    }
}
