<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\ProductSku;
class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            // 判断用户提交的地址 ID 是否存在于数据库并且属于当前用户
            // 后面这个条件非常重要，否则恶意用户可以用不同的地址 ID 不断提交订单来遍历出平台所有用户的收货地址
            'address_id' =>[
                // required 验证的字段必须存在于输入数据中，而不是空。如果满足以下条件之一，则字段被视为空：
                // 1.该值为 null.
                // 2.该值为空字符串。
                // 3.该值为空数组或空的 可数 对象。
                // 4.该值为没有路径的上传文件。
                //exists:table,column 验证的字段必须存在于给定的数据库表中。
                'required',Rule::exists('user_addresses', 'id')->where('user_id', $this->user()->id),
            ],
            // array 验证的字段必须是一个 PHP 数组。
            'items' => ['required', 'array'],
            // 检查 items 数组下每一个子数组的 sku_id 参数
            'items.*.sku_id' => [
                'required',  function ($attribute, $value, $fail) {
                    if (!$sku = ProductSku::find($value)) {
                        return $fail('该商品不存在');
                    }
                    if (!$sku->product->on_sale) {
                        return $fail('该商品未上架');
                    }
                    if ($sku->stock === 0) {
                        return $fail('该商品已售完');
                    }
                
                    // 获取当前索引
                    preg_match('/items\.(\d+)\.sku_id/', $attribute, $m);
                    $index = $m[1];
                    // 根据索引找到用户所提交的购买数量
                    $amount = $this->input('items')[$index]['amount'];
                    if ($amount > 0 && $amount > $sku->stock) {
                        return $fail('该商品库存不足');
                    }
                },
             ],
            // integer 验证的字段必须是整数。
            // min:value 验证中的字段必须具有最小值。字符串、数字、数组或是文件大小的计算方式都用 size 方法进行评估。
            'items.*.amount' => ['required', 'integer', 'min:1'],
        ];
    }
}
