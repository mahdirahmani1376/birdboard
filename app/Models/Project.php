<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $old = [];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        $this->tasks()->create(compact('body'));
    }

    public function updateTask($body)
    {
        $this->tasks()->update(compact('body'));
    }

    public function activity()
    {
        return $this->morphMany(Activity::class,'activatable')->latest();
    }

    public function recordActivity($description,$after= [],$before = [])
    {

        $activity = $this->activity()->create([
            'description' => $description,
            'changes' => [
                'before' => $before,
                'after' => $after,
            ],
        ]);

    }

}
