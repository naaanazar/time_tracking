<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'project_name',
        'hourly_rate',
        'notes'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}