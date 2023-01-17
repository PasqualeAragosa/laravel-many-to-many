<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'cover_image', 'description'];

    public static function createSlug($title)
    {
        $project_slug = Str::slug($title);

        return $project_slug;
    }
}
