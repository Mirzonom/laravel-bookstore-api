<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'price', 'stock'];

    protected $hidden = ['created_at', 'updated_at'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
