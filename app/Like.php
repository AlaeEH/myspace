<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Like extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
 
    protected $fillable = [
        'user_id',
        'user_liked_id',
        'created_at',
        'updated_at',
    ];
}