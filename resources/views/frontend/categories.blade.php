@extends('layouts.app')
@section('title')
    Kategoriler
@endsection

@section('content')
{{-- categories --}}
<div class="categories py-5" style="background: none">
    <div class="container">
        <h4 class="title">Kategoriler</h4>
        <div class="owl-carousel owl-theme" id="categories">
            @if ($categories->count() > 0)
                @foreach ($categories as $category)
                    <div class="item">
                        <a href="{{ url('view-category/'.$category->slug) }}" class="card bg-white text-center rounded border cat-img my-2 d-block">
                            <img src="{{asset('uploads/category/'.$category->photo)}}" alt="" class="w-100">
                            <h5 class="mb-0"><i class="fas fa-angle-double-right text-sm"></i> {{$category->name}}</h5>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="container">
                    <div class="bg-white shadow-sm p-5 border rounded my-5 text-center">
                        <h4 class="my-0">Kategori Mevcut Değil</h4>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</div>
@endsection