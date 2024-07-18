<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    public function posting()
    {
        return $this->belongsTo(Posting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
