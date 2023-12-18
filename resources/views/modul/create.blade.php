@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Tambah Modul
                        </div>
                       <div class="col-md-6">
                        <a href="{{route('modul.index')}}" class="float-end btn btn-success">Kembali</a>
                        </div>
                        
                    </div>
                    </div>
                

                <div class="card-body">
                    <form action="{{route('modul.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('post') 
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Judul</label>
                          <input  name="judul" type="teks" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>   
                          
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">file</label>
                            <input name="file" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                           
                          </div> 
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hari</label>
                            <select name="hari" class="form-select" id="inputGroupSelect02" required>
                              <option value="">Pilih Hari..</option>
                              <option value="Senin">Senin</option>
                              <option value="Selasa">Selasa</option>
                              <option value="Rabu">Rabu</option>
                              <option value="Kamis">Kamis</option>
                              <option value="Jumat">Jumat</option>
                              <option value="Sabtu">Sabtu</option>
                              <option value="Minggu">Minggu</option>
                            </select>
                            
                          </div>
                          <div class="form-floating mb-3">
                            <textarea class="form-control"  name="referensi" placeholder="Masukkan Referensi Disini" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Referensi</label>
                          </div>
                         
                          

                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
