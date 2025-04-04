<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'user_id'];  // Use 'user_id' instead of 'username'

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
