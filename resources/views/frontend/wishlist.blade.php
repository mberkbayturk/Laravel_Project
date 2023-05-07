@extends('layouts.app')
@section('title')
    İstek Listesi
@endsection

@section('content')
    {{-- wishlist --}}
    <div class="wishlist-section">
        @if ($wishlist->count() > 0)
            <div class="wishlist py-4">
                <div class="container">
                    <div>
                        <a href={{ url('/') }}>Ana Sayfa</a> \ <a href={{ url('wishlist') }}>İstek Listesi</a>
                    </div>
                    <h4 class="title">İstek Listesi</h4>
                    <div class="table-responsive">
                        <table class="table text-center shadow-sm border bg-white rounded">
                            <thead>
                                <tr>
                                    <th>Görsel</th>
                                    <th>Ürün Adı</th>
                                    <th>Fiyat</th>
                                    <th>Aksiyon</th>
                                </tr>
                            </thead>
                            <tbody class="product_data">
                                @foreach ($wishlist as $item)
                                    <tr>
                                        <td>
                                            <img width="50px" class="mx-auto"
                                                src="{{ asset('uploads/product/' . $item->products->photo) }}" alt="">
                                        </td>
                                        <td>{{ $item->products->name }}</td>
                                        <td class="text-success">{{ number_format($item->products->selling_price)}} TL</td>
                                        <td>
                                            <input type="hidden" value="{{ $item->products->id }}" class="product_id">
                                            <a class="btn btn-sm btn-danger delete_wishlist_item" href="{{url('delete_wishlist_item')}}"> <i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="bg-white shadow-sm px-5 py-3 border rounded my-5 text-center">
                    <img src="{{ asset('images/wishlist-empty.gif') }}" class="d-block mx-auto my-2" width="220px">
                    <h4 class="my-0">İstek Listesi Boş</h4>
                    <a href="{{ url('all_categories') }}" class="btn btn-md bg-color text-white shadow-sm my-4">Alışverişe Devam Et</a>
                </div>
            </div>
        @endif
    </div>
@endsection
