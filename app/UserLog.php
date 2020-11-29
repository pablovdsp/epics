<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id',
        'data_old',
        'data_new'
    ];

    protected $casts = [
        'data_old' => 'json',
        'data_new' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
