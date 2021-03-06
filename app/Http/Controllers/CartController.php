<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Http\Requests\AddCartRequest;
use App\Models\ProductSku;
use App\Services\CartService;
class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


     //购物车列表

     public function index(Request $request){
       
        $cartItems = $this->cartService->get();
        $addresses = $request->user()->addresses()->orderBy('last_used_at', 'desc')->get();

        return view('cart.index', ['cartItems' => $cartItems, 'addresses' => $addresses]);
    }

    // 添加购物车
    public function add(AddCartRequest $request)
    {
       
        $skuId  = $request->input('sku_id');
        $amount = $request->input('amount');

        $this->cartService->add($request->input('sku_id'), $request->input('amount'));
        return [];
    }
   

    public function remove(ProductSku $sku, Request $request){

        $this->cartService->remove($sku->id);
       

        return [];
    }



}
