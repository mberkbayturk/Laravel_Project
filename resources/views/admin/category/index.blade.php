@extends('layouts.admin')
@section('content')
    <div class="card py-5 rounded shadow-sm bg-white p-4">
        <div class="row">
            <div class="col-md-9">
                <h4>Kategoriler</h4>
            </div>
            <div class="col-md-3">
                <a href="{{ url('addCategory') }}" class="btn btn-info btn-sm mb-0 me-3" style="float: right">Kategori Ekle</a>
            </div>
        </div>
        <hr class="bg-dark">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori Adı</th>
                        <th>Açıklama</th>
                        <th>Görsel</th>
                        {{-- <th>Created at</th> --}}
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td><img src="{{asset("uploads/category/".$item->photo)}}" style="width:60px" alt=""></td>
                        {{-- <td>{{ $item->created_at }}</td> --}}
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ url('editCategory/'.$item->id) }}">Düzenle</a>
                            <a class="btn btn-sm btn-danger" href="{{ url('deleteCategory/'.$item->id) }}">Sil</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection