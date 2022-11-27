<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function fee_category()
    {
        return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
}
