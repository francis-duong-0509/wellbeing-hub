<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'learning_outcome',
        'template_id',
        'back_template_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'template_id' => 'integer',
        'back_template_id' => 'integer',
    ];

    /*=============================================== RELATIONSHIPS ===============================================*/
    public function courses(): HasMany {
        return $this->hasMany(Course::class, 'course_type_id', 'id');
    }
}
