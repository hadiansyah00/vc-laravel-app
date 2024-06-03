<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'avatar', 'logo',
    ];

    public function projectClient()
    {
        return $this->belongsTo(ProjectClient::class);
    }
}
