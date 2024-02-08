<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormData extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'value','user_id'];
    protected $casts = [
        'value' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
