<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'bpm_users';
    protected $primaryKey = 'id';

    public $timestamps = false;
    // hidden from json
    protected $hidden = [
        'password', 'created_by', 'created_dt', 'updated_by', 'updated_dt'
    ];

    /**
     * Get the clients of the user.
     */
    public function clients()
    {
        return $this->hasMany('App\Model\Client', 'user_id', 'id');
    }
}
