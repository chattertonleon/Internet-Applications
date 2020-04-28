<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
  protected $fillable = ['user_id','item_id','reason'];

  
}
