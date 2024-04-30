<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['status','customer_name','customer_id','user_id','user_name','designer_id','printWorker_id','customer_notes','discount','tax','total'];
    protected $dates = ['deleted_at'];

    public function item()
    {
        return $this->belongsToMany('App\Models\Item');


    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' );


    }

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id', 'id' );

    }
    public function printWorker()
    {
        return $this->belongsTo(User::class, 'printWorker_id', 'id' );

    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id' );

    }
}
