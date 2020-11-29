<?php

namespace App\Observers;

use App\UserLog;

trait UserLogsObserver
{
    protected static function boot()
    {
        parent::boot();

        static::created(function($user){
            UserLog::create([
                'user_id'  => $user->id,
                'data_new' => $user
            ]);
        });

        static::updated(function($user){
            UserLog::create([
                'user_id'  => $user->id,
                'data_old' => $user->getOriginal(),
                'data_new' => $user
            ]);
        });

        static::deleted(function($user){
            UserLog::create([
                'user_id'  => $user->id,
                'data_old' => $user->getOriginal(),
                'data_new' => $user
            ]);
        });
    }
}