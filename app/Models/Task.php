<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $touches = ['project'];

    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
