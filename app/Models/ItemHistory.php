<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHistory extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'quantity', 'user_id','type'];

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }


    public function user()
    {
        return $this->belongsTo(User::class); // Pastikan Anda mengimpor model User jika belum
    }
 

}
