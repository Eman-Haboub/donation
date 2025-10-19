<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
        protected $table = 'families';

    protected $fillable = [
        'alias', 'real_name', 'public_region', 'information', 'address',
        'phone', 'img', 'members_count', 'income', 'national_id_encrypted',
        'status', 'verified', 'donated', 'goal'
    ];

    public function needs()
    {
        return $this->hasMany(Need::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    public function wallet()
{
    return $this->hasOne(\App\Models\Wallet::class);
}
public function family()
{
    return $this->belongsTo(\App\Models\Family::class);
}

}
