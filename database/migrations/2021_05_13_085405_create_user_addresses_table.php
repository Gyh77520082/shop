<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     * id	自增长 ID	unsigned big int	主键
     * user_id	该地址所属的用户	unsigned big int	外键
     * province	省	varchar	无
     * city	市	varchar	无
     * district	区	varchar	无
     * address	具体地址	varchar	无
     * zip	邮编	unsigned int	无
     * contact_name	联系人姓名	varchar	无
     * contact_phone	联系人电话	varchar	无
     * last_used_at	最后一次使用时间	datetime null	无
     * @return void
     */
    
    //table->foreign('user_id')->references('id')外键关联ID
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id')                 ->comment("自增ID");
            $table->unsignedBigInteger('user_id')       ->comment('用户ID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('province')                  ->comment('省份');
            $table->string('city')                      ->comment( '市' );
            $table->string('district')                  ->comment( '区' );
            $table->string('address')                   ->comment('详细地址');
            $table->unsignedBigInteger('zip')           ->comment('邮编');
            $table->string('contact_name')              ->comment("联系人姓名");
            $table->string('contact_phone')             ->comment("联系人电话");
            $table->dateTime('last_used_at')->nullable()->comment("最后操作时间"); 

            $table->timestamps();    
                                        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
