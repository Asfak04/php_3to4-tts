<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'book_id', 
        'issue_date', 
        'return_date', 
        'due_date', 
        'renewal_status', 
        'renewal_count', 
        'status',
        'last_returned_at'
    ];

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
