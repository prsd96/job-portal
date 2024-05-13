<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobListing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_title', 'company_name', 'location'
    ];

    protected $dates = ['deleted_at'];

    public function jobApplications()
    {
        return $this->hasMany(UserJobApplication::class);
    }
}
