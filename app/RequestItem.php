<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    protected $fillable = [
        'made_by',
        'made_by_email',
        'department',
        'made_to',
        'requested_item',
        'request_made_on',
        'approval_status',
    ];
}
