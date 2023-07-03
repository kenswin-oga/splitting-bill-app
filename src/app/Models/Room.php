<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'password',
        'attend_num',
    ];

    public function roomEntries()
    {
    return $this->hasMany(RoomEntries::class, 'room_id');
    }

    public function moneyRecords()
    {
        return $this->hasMany(MoneyRecords::class, 'room_id');
    }

}
