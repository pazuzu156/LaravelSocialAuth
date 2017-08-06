<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'account_id',
        'fbid', 'fbtoken',
        'gid', 'gtoken',
        'did', 'dtoken',
        'ghid', 'ghtoken',
    ];

    public function account()
    {
        $acc = $this->belongsTo(Account::class);

        return ($acc->count() > 0) ? $acc->first() : false;
    }
}
