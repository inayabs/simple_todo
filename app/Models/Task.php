<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =[
        'name',
        'category',
        'content',
    ];

    public function category(){
        return $this->belongsTo(TaskCategory::class,'task_category_id');
    }
}
