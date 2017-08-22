<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'deadline'];

    // post->todo
    public function todo() {
      return $this->belongsTo('App\Todo');
    }
}
