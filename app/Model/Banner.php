<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $casts = [
        'published'  => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'resource_id')->select(['id','slug']);
    }

}
