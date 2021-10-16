<?php

namespace App\Models;

use App\Events\DeviceCreatedEvent;
use App\Events\DeviceCreatingEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $dispatchesEvents = [
        'creating' => DeviceCreatingEvent::class,
        'created' => DeviceCreatedEvent::class
    ];
}
