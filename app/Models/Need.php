<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = ['family_id', 'category', 'description', 'fulfilled'];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
