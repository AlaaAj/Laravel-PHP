<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['order_id','item_id','detail','quantity','amount','item_name','rate', 'attached_file'];
    protected $dates = ['deleted_at'];
}
