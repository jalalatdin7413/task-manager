<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'user_id',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'status' => TaskStatusEnum::class,
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
