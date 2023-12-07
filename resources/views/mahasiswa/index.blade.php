@extends('layout.template')

@section('konten')    
<h1 class="mt-3">
    <strong>Data Mahasiswa</strong>
</h1>

<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{ url('mahasiswa') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>

    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('/mahasiswa/create') }}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>              
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-3">NIM</th>
                <th class="col-md-4">Nama</th>
                <th class="col-md-2">Jurusan</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = $data->firstItem() // looping untuk menambahkan nomor data
            @endphp
            @foreach ($data as $item)                
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jurusan }}</td>
                <td>
                    <a href='{{ url('mahasiswa/'.$item->nim.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Apakah anda yakin?')" action="{{ url('mahasiswa/'.$item->nim) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>
            </tr>
            @php
                $no++
            @endphp
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>
<!-- AKHIR DATA -->
@endsection