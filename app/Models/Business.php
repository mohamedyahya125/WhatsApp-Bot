<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    protected $fillable = [
        'name',
        'description',
        'phone',
        'address',
        'status',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function whatsappCustomer(): HasMany
    {
        return $this->hasMany(WhatsappCustomer::class);
    }
}
