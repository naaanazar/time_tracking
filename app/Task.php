<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'project_id',
        'task_titly',
        'alloceted_hours',
        'assign_to',
        'task_type',
        'task_description',
        'billable'
    ];
}