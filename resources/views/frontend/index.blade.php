@extends('layouts.app')
@section('title')
    KouFood
@endsection

@section('content')
    <header class="py-5">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-6">
                    <div class="text">
                        <h1>KouFood <small>Online Yemek Sitesi</small></h1>
                        <p>
                            Yeni Bir Deneyim Yaşamak İster Misiniz?
                        </p>
                        <p class="mb-4">
                            Yemek Kalitemiz ile Damaklarda Mükemmel Bir Tat Bırakıyoruz
                        </p>
                        <form action="{{ url('search_product') }}" class="input-group mb-3 no-style-group" method="POST">
                            @csrf
                            <input required name="search" id="tags" type="search" class="form-control no-style"
                                placeholder="Ürün İsmini Giriniz">
                            <div class="input-group-prepend">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- categories --}}
    <img src="{{asset('images/wave1.svg')}}" class="w-100 d-block" alt="">
    <div class="categories pt-1 pb-3">
        <div class="container">
            <h3 class="title">Trend Kategoriler</h3>
            <div class="owl-carousel owl-theme" id="categories">
                @if ($categories->count() > 0)
                    @foreach ($categories as $popularCat)
                        <div class="item text-center">
                            <a href="{{ url('view-category/' . $popularCat->slug) }}"
                                class="card bg-white rounded border my-2 cat-img d-block overflow-hidden">
                                <img src="{{ asset('uploads/category/' . $popularCat->photo) }}" alt=""
                                    >
                                <h5 class="mb-0"> <i class="fas fa-angle-double-right text-sm"></i> {{ $popularCat->name }}</h5>
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <img src="{{asset('images/wave2.svg')}}" class="w-100 d-block" alt="">

    {{-- products --}}
    <div class="products py-4">
        <div class="container">
            <h3 class="title">Ürünler</h3>
            <div class="owl-carousel owl-theme" id="products">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="item product_data">
                            <div class="product-card bg-white rounded shadow-sm border my-2 overflow-hidden">
                                <input type="hidden" value="{{ $product->id }}" class="product_id">
                                <input type="hidden" value="1" class="input-qty">
                                <a href="{{ url('add_to_wishlist') }}" data-toggle="tooltip" data-placement="left"
                                    title="Add to wishlist" class="add_to_wishlist"><img
                                        src="{{ asset('images/heart.png') }}" alt=""></a>
                                <a href="{{ url('add_to_cart') }}"data-toggle="tooltip" data-placement="left"
                                    title="Add to cart" class="add_to_cart"><img src="{{ asset('images/add-to-cart.png') }}"
                                        alt=""></a>
                                <div class="p-3"><img src="{{ asset('uploads/product/' . $product->photo) }}" alt="" class="main"></div>
                                <div class="content">
                                    @if ($product->trending == 1)
                                        <div class="badge bg-danger float-right text-white">Trend</div>
                                    @endif
                                    <h5>{{ $product->name }}</h5>
                                    <small class="tag">{{ $product->category->name }} <i class="fas fa-tag"></i>
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
                                        @for ($j = number_format($stars_num) + 1; $j <= 5; $j++)
                                            <i class="fas fa-star text-secondary"></i>
                                        @endfor
                                        @for ($i = 1; $i <= number_format($stars_num); $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                    </div>
                                    <div>
                                        <b class="text-success">{{ number_format($product->selling_price) }} TL</b>
                                        <del class="text-danger text-sm">{{ number_format($product->original_price) }}
                                            TL</del>
                                    </div>
                                    <div>
                                        <a class="shadow-sm view_details"
                                            href="{{ url('details/' . $product->category->slug . '/' . $product->slug) }}">Detayları Görüntüle</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>


    {{-- testimonials --}}
    <div class="testimonials py-5">
        <div class="container">
            <h4 class="title">Görüşler</h4>
            <div class="owl-carousel owl-theme" id="testimonials">
                <div class="item">
                    <div class="test my-4 text-center bg-white rounded shadow-sm border p-4">
                        <img src="{{asset('images/left-quotes.png')}}" class="quotes" alt="">
                        <div class="img">
                            <img src="{{asset('images/avatar.png')}}" alt="">
                        </div>
                        <p class="my-4 line-height text-secondary text-sm">
                            Yediğim en iyi pizza buradaydı.
                        </p>
                        <b class="d-block font-italic">Ayşe VAROL</b>
                    </div>
                </div>
                <div class="item">
                    <div class="test my-4 text-center bg-white rounded shadow-sm border p-4">
                        <img src="{{asset('images/left-quotes.png')}}" class="quotes" alt="">
                        <div class="img">
                            <img src="{{asset('images/avatar.png')}}" alt="">
                        </div>
                        <p class="my-4 line-height text-secondary text-sm">
                            Hızlı teslimat ve sıcak hamburgerlerini kesinlikle yemelisiniz.
                        </p>
                        <b class="d-block font-italic">Can KORKMAZ</b>
                    </div>
                </div>
                <div class="item">
                    <div class="test my-4 text-center bg-white rounded shadow-sm border p-4">
                        <img src="{{asset('images/left-quotes.png')}}" class="quotes" alt="">
                        <div class="img">
                            <img src="{{asset('images/avatar.png')}}" alt="">
                        </div>
                        <p class="my-4 line-height text-secondary text-sm">
                            Pizzasına bayıldım.
                        </p>
                        <b class="d-block font-italic">Canan SOLMAZ</b>
                    </div>
                </div>
                <div class="item">
                    <div class="test my-4 text-center bg-white rounded shadow-sm border p-4">
                        <img src="{{asset('images/left-quotes.png')}}" class="quotes" alt="">
                        <div class="img">
                            <img src="{{asset('images/avatar.png')}}" alt="">
                        </div>
                        <p class="my-4 line-height text-secondary text-sm">
                            Mutlaka sipairiş vermelisiniz.
                        </p>
                        <b class="d-block font-italic">Ali TAHA</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
