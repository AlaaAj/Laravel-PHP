<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','price','photo'];
    protected $dates = ['deleted_at'];

    public function order()
    {
        return $this->belongsToMany('App\Models\Order');

      //  (Item::class, 'item_id' );

    }

}
