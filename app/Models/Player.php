<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';

    // Define the inverse relationship with the Transaction model
    public function playerlist()
    {
        return $this->hasMany(Transaction::class);
    }
}
