<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;

class ProductsController extends Controller
{
    //

    public function index(Request $request){


        //创建一个构造器
        $builder=Product::query()->where('on_sale',true);
        $search=$request->input('search','');
        if($search){
            $like = '%'.$search.'%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where( function($query) use($like){
                $query  ->where('title','like',$like)
                        ->orwhere('description','like',$like)
                        ->orWhereHas('skus',function($query) use ($like){
                            $query  ->where('title', 'like', $like)
                                    ->orWhere('description', 'like', $like);
                        });
            });
        }

        $order=$request->input('order','');
        
        if($order){
            // 是否是以 _asc 或者 _desc 结尾
            if(preg_match('/^(.+)_(asc|desc)$/',$order,$matches)){
                $key=['price', 'sold_count', 'rating'];
                if(in_array($matches[1], $key)){
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($matches[1], $matches[2]);
                };
            };
        };

        $products = $builder->paginate(16);

        return view('products.index', 
            [ 
            'products' => $products,
            'filters'  => [ 
                'search' => $search,
                'order'  => $order,
            ],
        ]);
    }

    public function show(Request $request,Product $product){
       
        if(! $product->on_sale){
            throw new InvalidRequestException('商品未上架');
        }

        $user=$request->user();
        $favored = false;
        if($user){

           
                // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品
                // boolval() 函数用于把值转为布尔值
            $favored=boolval($user->favoriteProducts()->find($product->id));
        }

        $reviews = OrderItem::query()
        ->with(['order.user', 'productSku']) // 预先加载关联关系
        ->where('product_id', $product->id)
        ->whereNotNull('reviewed_at') // 筛选出已评价的
        ->orderBy('reviewed_at', 'desc') // 按评价时间倒序
        ->limit(10) // 取出 10 条
        ->get();

        return view('products.show', [
            'product' => $product,
            'favored' => $favored,
            'reviews' => $reviews
        ]);
    }

    //收藏
    public function favorite(Request $request,Product $product){

        $user=$request->user();

        $favorProduct=$user->favoriteProducts();

        if( $favorProduct->find($product->id) ){

            return [];
        }
        //添加多对多关联 attach:
        $favorProduct->attach($product);

        return [];
    }

    // 取消收藏
    public function disFavorite(Request $request,Product $product){
        $user = $request->user();

        //detach 删除多对多关联，同步多对多关联 sync:
        $user->favoriteProducts()->detach($product);

        return [];
    }
    
    //收藏列表
    public function favoriteslist(Request $request){
        $user = $request->user();
        $products = $user->favoriteProducts()->paginate(16);
        
      
      

        return view('products.favoriteslist', ['products' => $products]);
    }

   
}
