@extends('layouts.app')
@section('title')
    Ödeme Alanı
@endsection

@section('content')
    {{-- checkout --}}
    <div class="container">
        <h4 class="title">Ödeme Alanı</h4>
        <form action="{{ url('place_order') }}" method="POST" class="checkout p-3 my-2 shadow-sm bg-white border rounded">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card p-3 my-2 border-0 rounded">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Temel Bilgiler</h5>
                        </div>
                        <div class="card-body px-0 checkout-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>Ad</label>
                                    <input type="text" class="fName" required value="{{ Auth::user()->name }}"
                                        name="fName">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>Soyad</label>
                                    <input type="text" class="lName" required value="{{ Auth::user()->lName }}"
                                        name="lName">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>E-mail</label>
                                    <input type="email" class="email" required value="{{ Auth::user()->email }}"
                                        name="email">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>Telefon Numarası</label>
                                    <input type="text" class="phone" required value="{{ Auth::user()->phone }}"
                                        name="phone" inputmode="numeric">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>Şehir</label>
                                    <input type="text" class="city" required value="{{ Auth::user()->city }}"
                                        name="city">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>İlçe</label>
                                    <input type="text" class="state" required value="{{ Auth::user()->state }}"
                                        name="state">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>Ülke</label>
                                    <input type="text" class="country" required value="{{ Auth::user()->country }}"
                                        name="country">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>Posta Kodu</label>
                                    <input type="text" class="pincode" required value="{{ Auth::user()->pincode }}"
                                        name="pincode" inputmode="numeric">
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>1. Adres</label>
                                    <textarea class="address1" name="address1" required>{{ Auth::user()->address1 }}</textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label>2. Adres</label>
                                    <textarea class="address2" name="address2" required>{{ Auth::user()->address2 }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card p-3 my-2 border-0 rounded">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Sipariş Detayları</h5>
                        </div>
                        <div class="card-body px-0">
                            @php
                                $total = 0;
                            @endphp
                            @if ($cartItems->count() > 0)
                                <table class="table table-striped border text-center">
                                    <thead>
                                        <tr>
                                            <th>Ürün Adı</th>
                                            <th>Miktar</th>
                                            <th>Fiyat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->product_qty }}</td>
                                                <td>{{ $item->products->selling_price }} TL</td>
                                            </tr>
                                            @php
                                                $total += $item->products->selling_price * $item->product_qty;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <h5>Toplam Fiyat : <span class="text-success">{{ number_format($total) }} TL</span>
                                    </h5>
                                    <input type="hidden" name="payment_mode" value="COD">
                                    <button type="submit" class="mb-2 btn btn-md btn-info shadow-sm d-block w-100">Sonraki Aşamaya Geç</button>
                                </div>
                            @else
                                <div class="container">
                                    <div class="bg-white shadow-sm p-5 border rounded my-5 text-center">
                                        <h4 class="my-0">Ürün Mevcut Değil</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
