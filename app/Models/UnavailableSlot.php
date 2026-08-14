<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnavailableSlot extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'start_time',
        'end_time',
        'reason',
    ];
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
