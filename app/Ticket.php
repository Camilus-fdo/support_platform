<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
    	'ticket_id', 'customer_name', 'problem', 'email', 'phone_number'
	];
}
