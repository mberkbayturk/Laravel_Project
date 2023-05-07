@extends('layouts.admin')
@section('content')
    <div class="card py-5 rounded shadow-sm bg-white p-4">
        <div class="card-header">
            <h3>Ürün Güncelleme</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('updateProduct/'.$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-md-12">
                        <label class="mx-0">Ürün Adı</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" required class="form-control my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="mx-0">Etiket</label>
                        <input type="text" name="slug" id="slug" required value="{{ $product->slug }}" class="form-control my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="mx-0">Kısa Açıklama</label>
                        <input type="text" name="small_description" id="small_description" required value="{{ $product->small_description }}" class="form-control my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="mx-0">Açıklama</label>
                        <textarea type="text" rows="5" name="description" id="description" required class="form-control my-2">{{ $product->description }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control my-2">
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected':'' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Orijinal Fiyatı</label>
                        <input type="number" name="original_price" id="original_price" required value="{{ $product->original_price }}" class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Satış Fiyatı</label>
                        <input type="number" name="selling_price" id="selling_price" required value="{{ $product->selling_price }}" class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Miktar</label>
                        <input type="number" name="qty" id="qty" required value="{{ $product->qty }}" class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Vergi</label>
                        <input type="number" name="tax" id="tax" required value="{{ $product->tax }}" class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Meta Başlık</label>
                        <input type="text" name="meta_title" id="meta_title" required value="{{ $product->meta_title }}" class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Meta Açıklaması</label>
                        <input type="text" name="meta_description" id="meta_description" value="{{ $product->meta_description }}" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Meta Anahtar Kelimesi</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" required value="{{ $product->meta_keywords }}" class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="d-block mx-0">Durum</label>
                        <input type="checkbox" name="status" class="my-2" {{ $product->status == "1" ? 'checked' : ''}}>
                    </div>
                    <div class="col-md-6">
                        <label class="d-block mx-0">Trend mi?</label>
                        <input type="checkbox" name="trending" class="my-2" {{ $product->trending == "1" ? 'checked' : ''}}>
                    </div>
                    @if ($product->photo)
                        <img class="my-2" src="{{asset("uploads/product/".$product->photo)}}" style="width:100px;" alt="">
                    @endif
                    <div class="col-md-12">
                        <label class="d-block mx-0">Görsel Yükleme</label>
                        <input type="file" name="photo" class="my-2">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-md btn-primary">Güncelle</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection