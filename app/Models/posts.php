<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Likeable\Likeable;



class posts extends Model
{
    use HasFactory,Likeable;
    
   

    protected $table = 'posts';



    public function user()
{
    return $this->belongsTo(User::class);
}
}
