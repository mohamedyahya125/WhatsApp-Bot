<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'business_id',
        'name',
        'email',
        'phone',
        'hire_date',
        'status',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
    public function service(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'employee_service');
    }
    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function unavailableSlots(): HasMany
    {
        return $this->hasMany(UnavailableSlot::class);
    }
}
