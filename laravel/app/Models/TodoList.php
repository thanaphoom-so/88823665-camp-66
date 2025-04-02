<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $fillable = ['name', 'description', 'user_id'];
    protected $table = 'task';

    // ความสัมพันธ์: TodoList มีหลาย Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // ความสัมพันธ์: TodoList เป็นของ User คนหนึ่ง
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}