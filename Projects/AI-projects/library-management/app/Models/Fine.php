<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = ['book_issue_id', 'amount', 'status', 'paid_at'];

    public function bookIssue()
    {
        return $this->belongsTo(BookIssue::class);
    }
}
