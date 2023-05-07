@extends('layouts.admin')
@section('content')
    <div class="card py-5 rounded shadow-sm bg-white p-4">
        <div class="row">
            <div class="col-md-12">
                <h4>Siparişler</h4>
            </div>
        </div>
        <hr class="bg-dark">
        @if ($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped text-center border bg-white rounded">
                <thead>
                    <tr>
                        <th>Takip Numarası</th>
                        <th>Durum</th>
                        <th>TOplam Fiyat</th>
                        <th>Oluşturulma Zamanı</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->trackingNumber}}</td>
                            <td><span class="text-primary">{{$order->status == '0' ? 'Pending' : 'Completed'}}</span></td>
                            <td>{{$order->total_price}} EGP</td>
                            <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
                            <td><a class="btn btn-sm btn-info shadow-sm" href="{{url('admin/order_details/'.$order->id)}}">View details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="container">
                <div class="text-center">
                    <img src="{{asset('images/no-orders.gif')}}" class="d-block mx-auto my-2" width="220px">
                    <h4 class="my-0">Sipariş Mevcut Değil</h4>
                </div>
            </div>
        @endif
    </div>
@endsection