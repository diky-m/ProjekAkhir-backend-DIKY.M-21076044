@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Modul
                        </div>
                       <div class="col-md-6">
                        <a href="{{route('modul.create')}}" class="float-end btn btn-success">Tambah Data</a>
                        </div>
                        
                    </div>
                    </div>
                

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">File</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($data as $item)
                         <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->judul}}</td>
                            <td>{{$item->file}}</td>
                            <td>{{$item->hari}}</td>
                            <td>
                                <a href="{{route('modul.edit',$item->id)}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('modul.destroy', $item->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                              
                            </td>
                          
                         </tr>
                             
                         @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
