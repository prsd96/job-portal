<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserJobApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'job_listing_id'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
