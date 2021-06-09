<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *  guarded 黑名单表示不可被批量操作的值 fillable 表白名单 与guarded相反
     * @var array
     */
    protected $guarded=[
        'id',
        'user_id',

    ];

     /**
     * 表示 last_used_at 字段是一个时间日期类型
     * $address->last_used_at 返回的就是一个时间日期对象（确切说是 Carbon 对象，Carbon 是 Laravel 默认使用的时间日期处理类）。
     *
     * @var array
     */
    protected $dates = ['last_used_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * 创建访问器
     * $address->full_address 来获取完整的地址，而不用每次都去拼接。
     * 
     * @return string
     * 
     */

    public function getFullAddressAttribute(){
        
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    
    }
}
