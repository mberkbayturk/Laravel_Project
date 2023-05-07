@extends('layouts.app')
@section('title', $product->name)


@section('content')

    {{-- product details --}}
    <div class="products py-4">
        <div class="container">
            <div>
                <a href={{ url('/') }}>Ana Sayfa</a> \ <span>{{ $product->category->name }}</span> \
                <span>{{ $product->name }}</span>
            </div>
            <h4 class="title">Ürün Detayı</h4>
            <div class="card bg-white rounded border shadow-sm my-2 p-4 product_data">
                <div class="row details">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="zoom-image-container">
                            <div class="zoom-image" data-image="{{ asset('uploads/product/' . $product->photo) }}">
                                <img src="{{ asset('uploads/product/' . $product->photo) }}" alt="" class="w-100">
                            </div>
                          </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-12">
                        @if ($product->trending == 1)
                            <div class="badge bg-danger float-right text-white">Trend</div>
                        @endif
                        <h3>{{ $product->name }}</h3>
                        <small class="tag"><i class="fas fa-tag"></i> {{ $product->category->name }}</small>
                        <p class="custom-text mt-1 line-height">{{ $product->small_description }}</p>
                        <hr>
                        <b class="d-inline-block mb-3">Ürün Yıldızları:</b>
                        @php
                            $ratingNum = number_format($ratings_value);
                        @endphp
                        @for ($i = 1; $i <= $ratingNum; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                        @for ($j = $ratingNum + 1; $j <= 5; $j++)
                            <i class="fas fa-star text-secondary"></i>
                        @endfor
                        <small class="text-secondary text-sm">({{ number_format($ratings->count()) }} Yıldız)</small>
                        <div>
                            <b class="d-block">Fiyat:</b>
                            <del class="text-danger text-sm">{{ number_format($product->original_price) }} TL</del>
                            <b class="text-success">{{ number_format($product->selling_price) }} Tl</b>
                        </div>
                        @if ($product->qty > 0)
                            <div class="badge bg-success text-white my-2">Stokta Var</div>
                            <b class="d-block mt-2">Miktar</b>
                            <div class="input-group mt-3 mb-3" style="width:120px;">
                                <input type="hidden" value="{{ $product->id }}" class="product_id">
                                <input type="hidden" value="{{ $product->qty }}" class="productQty">
                                <div class="input-group-prepend">
                                    <button class="decrement-btn"><i
                                            class="fas fa-minus fa-sm"></i></button>
                                </div>
                                <input type="text" value="1" disabled
                                    class="bg-white mt-0 form-control text-center input-qty no-style">
                                <div class="input-group-append">
                                    <button class="increment-btn"><i
                                            class="fas fa-plus fa-sm"></i></button>
                                </div>
                            </div>
                            <div class="my-3">
                                <a href="{{ url('add_to_cart') }}" class="custom-btn1 add_to_cart">Sepete Ekle<i class="fas fa-shopping-cart fa-sm"></i></a>
                                <a href="{{ url('add_to_wishlist') }}"
                                    class="custom-btn2 add_to_wishlist">İstek Listesine Ekle <i class="fas fa-heart fa-sm"></i></a>
                            </div>
                        @else
                            <div class="badge bg-danger text-white">Stokta Yok</div>
                        @endif

                    </div>
                    <div class="col-lg-12 col-md-12 col-12"><hr></div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <b>Açklama</b>
                        <p class="custom-text desc">{{ $product->description }}</p>
                        <div class="px-2 py-1 border d-inline-block rounded mb-3">
                            <button type="button" data-toggle="modal" data-target="#rating" class="btn pl-0 btn-link text-warning"><i
                                class="fas fa-star fa-sm"></i> Bu Ürünü Puanla</button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <b>Ürün Yorumları</b>
                            <a href="{{ url('add_review/' . $product->slug . '/user_review') }}"
                                class="btn btn-dark btn-sm">
                                Yorum Ekle <i class="fas fa-comment"></i>
                            </a>
                        </div>
                        <hr>
                        @if ($reviews->count() > 0)
                            @foreach ($reviews as $review)
                                <div class="user_review">
                                    <b>{{ $review->user->name . ' ' . $review->user->lName }}</b>
                                    @if ($review->user_id == Auth::id())
                                        <a href="{{ url('edit_review/' . $product->slug . '/user_review') }}"
                                            class="btn-sm text-secondary btn-link"><i class="fas fa-pen fa-sm"></i> Düzenle</a>
                                    @endif
                                    <br>
                                    <small>
                                        @php
                                            $userRating = App\Models\Rating::where('product_id',$product->id)->where('user_id',$review->user->id)->first();
                                        @endphp
                                        @if ($userRating)
                                            @php
                                                $user_rate = $userRating->stars_rated;
                                            @endphp
                                            @for ($i = 1; $i <= $user_rate; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                            @for ($j = $user_rate + 1; $j <= 5; $j++)
                                                <i class="fas fa-star text-secondary"></i>
                                            @endfor
                                            @else
                                                <i class="fas fa-star text-secondary"></i>
                                                <i class="fas fa-star text-secondary"></i>
                                                <i class="fas fa-star text-secondary"></i>
                                                <i class="fas fa-star text-secondary"></i>
                                                <i class="fas fa-star text-secondary"></i>
                                        @endif
                                    </small><br>
                                    <small>Görüntülemede {{ $review->created_at->format('d/m/Y') }}</small>
                                    <p class="my-2 p-2 custom-text desc border-left">
                                        {{ $review->review }}
                                    </p>
                                    <hr>
                                </div>
                            @endforeach
                        @else
                            <p class="text-secondary">Yorum Yok</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- products --}}
    <div class="products py-4">
        <div class="container">
            <h4 class="title">İlişkili Ürünler </h4>
            @if ($related_products->count() > 0)
                <div class="row">
                    @foreach ($related_products as $item)
                        <div class="product_data col-lg-3 col-md-6 col-6">
                            <div class="product-card bg-white border shadow-sm rounded my-2 overflow-hidden">
                                <input type="hidden" value="{{ $item->id }}" class="product_id">
                                <input type="hidden" value="1" class="input-qty">
                                <a href="{{ url('add_to_wishlist') }}" data-toggle="tooltip" data-placement="left"
                                    title="Add to wishlist" class="add_to_wishlist"><img
                                        src="{{ asset('images/heart.png') }}" alt=""></a>
                                <a href="{{ url('add_to_cart') }}"data-toggle="tooltip" data-placement="left"
                                    title="Add to cart" class="add_to_cart"><img src="{{ asset('images/add-to-cart.png') }}"
                                        alt=""></a>
                                <img src="{{ asset('uploads/product/' . $item->photo) }}" alt="" class="main">
                                <div class="content">
                                    @if ($item->trending == 1)
                                        <div class="badge bg-danger float-right text-white">Trend</div>
                                    @endif
                                    <h5>{{ $item->name }}</h5>
                                    <small class="tag"> <i class="fas fa-tag"></i> {{ $item->category->name }}
                                    </small>
                                    <p class="my-2">{{ $item->small_description }}</p>
                                    <div class="mb-1">
                                        @php
                                            $stars_count = number_format($item->ratings->count());
                                            $stars = number_format($item->totalRatings());
                                        @endphp
                                        @if ($item->ratings->count() > 0)
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
                                        <del class="text-danger text-sm">{{ number_format($item->original_price) }}
                                            EGP</del>
                                        <b class="text-success">{{ number_format($item->selling_price) }} EGP</b>
                                    </div>
                                    <div>
                                        <a class="shadow-sm view_details"
                                            href="{{ url('details/' . $item->category->slug . '/' . $item->slug) }}">Detayları Görüntüle</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="my-2">{{ $related_products->links() }}</div>
                @else
                <div class="bg-white shadow-sm p-5 border rounded my-5 text-center">
                    <h4 class="my-0">Ürün Mevcut Değil</h4>
                </div>
            @endif
        </div>
    </div>

    {{-- rating --}}
    <div class="modal fade" id="rating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('add_rating') }}" class="modal-content" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if ($user_ratings)
                                @for ($i = 1; $i <= $user_ratings->stars_rated; $i++)
                                    <input type="radio" value="{{ $i }}" name="product_rating" checked
                                        id="rating{{ $i }}">
                                    <label for="rating{{ $i }}" class="fa fa-star"></label>
                                @endfor
                                @for ($j = $user_ratings->stars_rated + 1; $j <= 5; $j++)
                                    <input type="radio" value="{{ $j }}" name="product_rating"
                                        id="rating{{ $j }}">
                                    <label for="rating{{ $j }}" class="fa fa-star"></label>
                                @endfor
                            @else
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Oyla</button>
                </div>
            </form>
        </div>
    </div>
@endsection
