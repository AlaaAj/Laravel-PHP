<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['detail','amount','discount','total','user_id','user_name','order_id'];
    protected $dates = ['deleted_at'];



    public function user()
    {
        return $this->belongsTo('App\User', 'user_id' );

    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id' );
    }
}
