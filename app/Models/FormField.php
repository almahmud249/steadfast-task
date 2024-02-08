<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable=['category_id','form_data'];

    protected $casts=[
        'form_data' => 'array'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }
}
