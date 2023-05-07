@extends('layouts.admin')
@section('title')
    Order details
@endsection

@section('content')
    {{-- orders --}}
    <div class="orders px-3 py-5 bg-white rounded shadow-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h4>Sipariş Detayları</h4>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('orders') }}" class="btn btn-info btn-sm mb-0 me-3" style="float: right">Siparişler</a>
                </div>
            </div>
            <hr class="bg-dark">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <b class="d-block">Sipariş Adı:</b>
                            {{$orders->fName}} {{$orders->lName}}
                        </li>
                        <li class="list-group-item">
                            <b class="d-block">Email:</b>
                            {{$orders->email}}
                        </li>
                        <li class="list-group-item">
                            <b class="d-block">Telefon:</b>
                            {{$orders->phone}}
                        </li>
                        <li class="list-group-item">
                            <b class="d-block">Posta Kdou:</b>
                            {{$orders->pincode}}
                        </li>
                        <li class="list-group-item">
                            <b class="mb-2 d-block">Gönderi Adresi:</b>
                            <div class="mb-2">{{$orders->address1}},</div>
                            <div class="mb-2">{{$orders->address2}},</div>
                            <div>{{$orders->city}},{{$orders->state}},{{$orders->country}}</div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="p-3 border">
                        <div class="table-responsive">
                        <table class="table table-striped text-center border">
                            <thead>
                                <tr>
                                    <th>Görsel</th>
                                    <th>Ürün İsmi</th>
                                    <th>Miktar</th>
                                    <th>Fiyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->orderitems as $order)
                                    <tr>
                                        <td><img src="{{asset('uploads/product/'.$order->products->photo)}}" width="60px" class="mx-auto" alt=""></td>
                                        <td>{{$order->products->name}}</td>
                                        <td>{{$order->product_qty}}</td>
                                        <td>{{$order->product_price}} EGP</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="text-left">
                            <h5>Toplam: {{$orders->total_price}} TL</h5>
                            <form action="{{url('update_status/'.$orders->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <label>Sipariş Durumu</label>
                                <select name="order_status" class="form-control mb-3">
                                    <option {{$orders->status == '0'?'selected':''}} value="0">Askıda</option>
                                    <option {{$orders->status == '1'?'selected':''}} value="1">Tamamlandı</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-dark">Güncelle Durumu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
@endsection