@extends('layouts.app')

@section('content')
<style type="text/css">
  .table{
    background-color:#dcdcdc;
  }
  .card{
    background-color:#1E90FF;
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List Surat') }}</div><br>
                <div class="container">
                    <td>
                    <a class="btn btn-outline-info" href="/form-tambah"> Add </a>
                    <a class="btn btn-outline-warning" href="/download-pdf"> Print </a>
                    </td>
                    <br><br>
                <table class="table">
                    <thead class="bg-secondary text-white">
                      <tr>
                      <th>No Surat</th>
                      <th>Tanggal</th>
                      <th>Pengirim</th>
                      <th>IMAGE</th>
                      <th>ACTION</th>
                      </tr>
                    </thead>
                      @if (empty($data))
                          <tr >
                              <td class="alert alert-danger" role="alert" colspan="4">Data Kosong </td>
                          </tr>
                      @endif
                          @foreach($data as $i)
                          <tbody>
                          <tr>
                              <td>{{ $i->plat }}</td> 
                              <td>{{ $i->merk }}</td> 
                              <td>{{ $i->tipe }}</td>
                              <td><img src="{{ asset('images') }}/{{ $i->profileimage }}" style="max-width:60px;"></td>
                              <td>
                                  <a class="btn btn-success" href="/ubah-hape/{{$i->id}}">Edit</a>
                                  <a class="btn btn-danger" href="/hapus-hape/{{$i->id}}"> Hapus</a>
                              </td>
                          </tr>
                          </tbody>
                          @endforeach
                    </table>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
