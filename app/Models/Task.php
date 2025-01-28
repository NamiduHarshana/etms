<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory; // Added for database factory support

    protected $fillable = ['title', 'description', 'due_date', 'status', 'employee_id'];

    /**
     * The employee associated with the task.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
