@extends('layouts.app')
@section('title')
    Ürünler
@endsection

@section('content')

    {{-- products --}}
    <div class="products py-4">
        <div class="container">
            <h4 class="title">Ürünler</h4>
            @if ($products->count() > 0)
                <div class="row">
                        @foreach ($products as $product)
                        <div class="product_data col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white shadow-sm border rounded my-2 overflow-hidden">
                                <input type="hidden" value="{{ $product->id }}" class="product_id">
                                <input type="hidden" value="1" class="input-qty">
                                <a href="{{ url('add_to_wishlist') }}" data-toggle="tooltip" data-placement="left"
                                    title="Add to wishlist" class="add_to_wishlist"><img
                                        src="{{ asset('images/heart.png') }}" alt=""></a>
                                <a href="{{ url('add_to_cart') }}"data-toggle="tooltip" data-placement="left"
                                    title="Add to cart" class="add_to_cart"><img src="{{ asset('images/add-to-cart.png') }}"
                                        alt=""></a>
                                <img src="{{ asset('uploads/product/' . $product->photo) }}" alt="" class="main">
                                <div class="content">
                                    @if ($product->trending == 1)
                                        <div class="badge bg-danger float-right text-white">Trend</div>
                                    @endif
                                    <h5>{{ $product->name }}</h5>
                                    <small class="tag"> <i class="fas fa-tag"></i> {{ $product->category->name }}
                                    </small>
                                    <p class="my-2">{{ $product->small_description }}</p>
                                    <div class="mb-1">
                                        @php
                                            $stars_count = number_format($product->ratings->count());
                                            $stars = number_format($product->totalRatings());
                                        @endphp
                                        @if ($product->ratings->count() > 0)
                                            @php
                                                $stars_num = $stars / $stars_count;
                                            @endphp
                                        @else
                                            @php
                                                $stars_num = 0;
                                            @endphp
                                        @endif
                                        @for ($i = 1; $i <= number_format($stars_num); $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        @for ($j = number_format($stars_num) + 1; $j <= 5; $j++)
                                            <i class="fas fa-star text-secondary"></i>
                                        @endfor
                                    </div>
                                    <div>
                                        <del class="text-danger text-sm">{{ number_format($product->original_price) }}
                                            TL</del>
                                        <b class="text-success">{{ number_format($product->selling_price) }} TL</b>
                                    </div>
                                    <div>
                                        <a class="shadow-sm view_details"
                                            href="{{ url('details/' . $product->category->slug . '/' . $product->slug) }}">Detayları Görüntüle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="my-2">{{ $products->links() }}</div>
                @else
                <div class="bg-white shadow-sm p-5 border rounded my-5 text-center">
                    <h4 class="my-0">Ürün Mevcut Değil</h4>
                </div>
            @endif
        </div>
    </div>
@endsection
