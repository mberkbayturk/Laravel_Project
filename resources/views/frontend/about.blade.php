@extends('layouts.app')
@section('title')
    Hakkımızda
@endsection

@section('content')
{{-- services --}}
<div class="services py-5">
    <div class="container">
        <h4 class="title">Hakkımızda</h4>
        <div class="card rounded shadow-sm my-3 p-4">
            <p class="mb-0 text-secondary my-3 line-height"> <b>
                KouFood Sipariş Sistemi </b><br>
                
            </p>
            <b class="d-block text-color1">Vizyon:</b>
            <ul class="my-2">
                <li class="text-secondary text-sm my-1">Müşteri memnuniyetini temel prensibimiz olarak benimsemek.</li>
                <li class="text-secondary text-sm my-1">Güvenilir, kaliteli, sağlıklı, hijyenik ve lezzetli hizmetler sunmak.</li>
                <li class="text-secondary text-sm my-1">Yemek sektörünün kalite çıtasını sürekli yukarı çeken bir firma olmak.</li>
            </ul>
            <b class="d-block text-color1">Misyon:</b>
            <ul class="my-2">
                <li class="text-secondary text-sm my-1">Kalite ve hizmet anlayışından vazgeçmeden, sürekli yenilenen ve gelişen, sektöründeki yerini koruyan 
                    bir firma olmak.
                </li>
                <li class="text-secondary text-sm my-1">müşteri memnuniyetini devamlı kılan, en önemlisi de yemek sektöründe kaliteyi ve
                     insan sağlığını önemseyen müşterilerin tercih ettiği firma olmak.</li>
                <li class="text-secondary text-sm my-1">KouFood hizmetlerini sunarken kalite velezzetten ödün vermeden maksimum müşterimemnuniyetini hedeflemekte
                     ve hizmetlerinde dürüst,saygılı, adil, açık ve şeffaf olmaya özen göstermektedir.</li>
            </ul>
        </div>
    </div>
</div>
@endsection