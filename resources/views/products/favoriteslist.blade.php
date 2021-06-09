@extends('layouts.app')
@section('title','我的收藏')
@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1" >
            <div class="card">
                <div class="card-header">
                    我的收藏
                </div>
                <div class="card-body" >
                    <div class="row products-list">
                        @include('products.products')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection