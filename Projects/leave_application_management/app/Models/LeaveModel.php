<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class LeaveModel extends Model
{
    use HasFactory;
    protected $fillable = ['employee_name','type','start_date','end_date','reason','status'];
    protected $table = "leave_requests";
}
