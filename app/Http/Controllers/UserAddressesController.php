<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Http\Requests\UserAddressRequest;

class UserAddressesController extends Controller
{
    /**
     * 
     * 带参返回 user_addresses.index
     * 
     */
    public function index(Request $request){


        $addresses=$request->user()->addresses;
        return view('user_addresses.index',['addresses'=> $addresses]);

    }

    public function create(){
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    public function store(UserAddressRequest $request){
        $address=$request->user()->addresses();
        //dd($request->validated());
        // dd($request->only(['province','city','district','address','zip','contact_name','contact_phone', ]));
        $input=$request->only(['province','city','district','address','zip','contact_name','contact_phone', ]);

        $address->create($input);
        return redirect()->route('user_addresses.index');
    }



    public function edit(UserAddress $user_address){


        $this->authorize('own',$user_address);
        return view('user_addresses.create_and_edit',['address'=> $user_address]);
    }


    public function update(UserAddress $user_address,UserAddressRequest $request){

        $this->authorize('own',$user_address);
        $input=$request->validated();
        // dd($input);
        $user_address->update($input);
        return redirect()->route('user_addresses.index');
    }


    public function destroy(UserAddress $user_address)
    {
        $this->authorize('own',$user_address);
        $user_address->delete();

        return [];
    }

}
