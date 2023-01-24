<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categorys';
    public $timestamps=false;

    public static function getCategory($id)
    {
        $category=Category::find($id);
        return $category->name;
    }
}
