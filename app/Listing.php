<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $guarded = [];

    public function getUser()
    {
        $this->hasOne(User::class, 'user_id', 'id');
    }
}
