<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_client_id', 'content', 'author', 'thumbnail',
    ];
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
