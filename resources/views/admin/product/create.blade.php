@extends('layouts.admin')
@section('content')
    <div class="card py-5 rounded shadow-sm bg-white p-4">
        <div class="card-header">
            <h3>Ürün Ekleme</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('insertProduct') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="mx-0">Ürün Adı</label>
                        <input type="text" name="name" id="name" required class="form-control my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="mx-0">Etiket</label>
                        <input type="text" name="slug" id="slug" required class="form-control my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="mx-0">Kısa Açıklama</label>
                        <input type="text" name="small_description" id="small_description" required class="form-control my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="mx-0">Açıklama</label>
                        <textarea type="text" rows="5" name="description" id="description" required class="form-control my-2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control my-2">
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Orijinal Fiyatı</label>
                        <input type="number" name="original_price" id="original_price" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Satış Fiyatı</label>
                        <input type="number" name="selling_price" id="selling_price" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Miktar</label>
                        <input type="number" name="qty" id="qty" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Vergi</label>
                        <input type="number" name="tax" id="tax" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Meta Başlık</label>
                        <input type="text" name="meta_title" id="meta_title" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Meta Açıklaması</label>
                        <input type="text" name="meta_description" id="meta_description" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Meta Anahtar Kelimesi</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="d-block mx-0">Durum</label>
                        <input type="checkbox" name="status" class="my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="d-block mx-0">Trend mi?</label>
                        <input type="checkbox" name="trending" class="my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="d-block mx-0">Görsel Yükleme</label>
                        <input type="file" name="photo" accept="image/*" class="my-2">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-md btn-primary">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection