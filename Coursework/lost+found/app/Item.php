<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category','color','date_lost','details','place','claim_status','claimed_user_id'];
}
