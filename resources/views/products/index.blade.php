@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card">
            <div class="card-body">
                <!-- seach begin -->
                    <form action="{{ route('products.index') }}" class="search-form">
                        <div class="form-row">
                            <div class="col-md-9">
                                <div class="form-row">
                                    <div class="col-auto">
                                        <input type="text" class="form-control form-control-sm" name="search" placeholder="搜索">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary btn-sm">搜索</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="order" class="form-control form-control-sm float-right">
                                    <option value="">排序方式</option>
                                    <option value="price_asc">价格从低到高</option>
                                    <option value="price_desc">价格从高到低</option>
                                    <option value="sold_count_desc">销量从高到低</option>
                                    <option value="sold_count_asc">销量从低到高</option>
                                    <option value="rating_desc">评价从高到低</option>
                                    <option value="rating_asc">评价从低到高</option>
                                </select>
                            </div>
                        </div>
                    </form>
                <!-- seach end -->
                <div class="row products-list">
                   @include('products.products')
                </div>
                <div class="float-right">{{ $products->appends($filters)->render() }}</div>
            </div>
        </div>
    </div>
    
</div>
    @section('scriptsAfterJs')
        <script>
            var filters = {!! json_encode($filters) !!};
            $(document).ready(function () {
                $('.search-form input[name=search]').val(filters.search);
                $('.search-form select[name=order]').val(filters.order);
                $('.search-form select[name=order]').on('change', function() {
                    $('.search-form').submit();
                });
            })
        </script>
    @endsection
@endsection
