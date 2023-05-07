@extends('layouts.admin')
@section('content')
    <div class="card py-5 rounded shadow-sm bg-white p-4">
        <div class="card-header">
            <h3>Kategori Ekleme</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('insertCategory') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="mx-0">Kategori Adı</label>
                        <input type="text" name="name" id="name" required class="form-control my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="mx-0">Etiket</label>
                        <input type="text" name="slug" id="slug" required class="form-control my-2">
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
                    <div class="col-md-12">
                        <label class="mx-0">Açıklama</label>
                        <textarea type="text" rows="3" name="description" id="description" required class="form-control my-2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="d-block mx-0">Durum</label>
                        <input type="checkbox" name="status" class="my-2">
                    </div>
                    <div class="col-md-6">
                        <label class="d-block mx-0">Popülerlik</label>
                        <input type="checkbox" name="popular" class="my-2">
                    </div>
                    <div class="col-md-12">
                        <label class="d-block mx-0">Görsel Yükleme</label>
                        <input type="file" name="photo" class="my-2">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-md btn-primary">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection