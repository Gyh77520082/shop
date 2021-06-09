<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded=[
      
    ];

    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function skus(){
        return $this->hasMany(ProductSku::Class);
    }

    public function getImageUrlAttribute(){

        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['images'], ['http://', 'https://'])) {
            return $this->attributes['images'];
        }
        return \Storage::disk('public')->url($this->attributes['images']);
    }
}
