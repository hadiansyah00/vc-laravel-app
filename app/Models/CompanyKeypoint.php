<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyKeypoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_about_id', 'keypoint',
    ];

    public function companyAbout()
    {
        return $this->belongsTo(CompanyAbout::class);
    }
}
