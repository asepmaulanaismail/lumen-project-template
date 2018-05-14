<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'bpm_clients';
    protected $primaryKey = 'id';

    public $timestamps = false;
    // hidden from json
    protected $hidden = [
        'password', 'created_by', 'created_dt', 'updated_by', 'updated_dt'
    ];

    /**
     * Get the user of the client.
     */
    public function parent()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }
}
