<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Encore\Admin\Traits\DefaultDatetimeFormat;
/**
 * implements   用于表示「实现」接口，可实现多个接口。
 * extends      表示「继承」类，且只能单继承。
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,DefaultDatetimeFormat;

    /**
     * The attributes that are mass assignable.
     *  guarded 黑名单表示不可被批量操作的值 fillable 表白名单 与guarded相反
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 应该为数组隐藏的属性。
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function addresses(){
        
        return $this->hasmany(UserAddress::class);
    }

    //收藏关联
    /**
     * belongsToMany() 方法用于定义一个多对多的关联，第一个参数是关联的模型类名，第二个参数是中间表的表名。
     * withTimestamps() 代表中间表带有时间戳字段。
     * orderBy('user_favorite_products.created_at', 'desc') 代表默认的排序方式是根据中间表的创建时间倒序排序。
     */
    public function favoriteProducts(){
        return $this->belongsToMany(Product::class,'user_favorite_products')
            ->withTimestamps()
            ->orderBy('user_favorite_products.created_at', 'desc');
    }
}
