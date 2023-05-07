@extends('layouts.app')
@section('title')
    Görüntüleme
@endsection

@section('content')

{{-- update review --}}
<div class="update_review py-4">
    <div class="container">
        <div class="card bg-white shadow-sm rounded border my-2 p-3">
            <h5 class="my-3 font-weight-bold">Review: {{$review->product->name}}</h5>
            <form action="{{'/update_review'}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" value="{{ $review->id }}" name="review_id" class="review_id">
                <h5 class="font-weight-bold my-3">Görüntüleme Ekle</h5>
                <textarea required name="review" class="p-2" placeholder="Give us a feedback about this product">{{$review->review}}</textarea>
                <button type="submit" class="custom-btn1">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@endsection