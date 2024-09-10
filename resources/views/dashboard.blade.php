@include('template/header')

<body style="height: 50rem">
    
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-4"><b>Data Mahasiswa</b></h3>
        </div>
        <div class="col-md-12 mb-3">
            <a href="/add-mahasiswa" class="btn btn-md btn-success float-end">Tambah Data</a>
        </div>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        {{session()->get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

        <table id="datatable" class="table table-striped">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($mahasiswa as $mhs)
                <tr>
                    <td>{{$mhs->nrp}}</td>
                    <td>{{$mhs->nama}}</td>
                    <td>{{$mhs->email}}</td>
                    <td>
                        <a href="{{url('edit-mahasiswa',$mhs->nrp)}}" class="btn btn-primary">Edit</a>
                        <a href="{{url('hapus-mahasiswa',$mhs->nrp)}}" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini?');">Delete</a>
                    </td>
                </tr>      
                @endforeach      --}}
            </tbody>
        </table>
        {{-- <form action="{{url('logout')}}" method="post">
        @csrf
        <div class="col-md-12 mb-3">
            <button class="btn btn-md btn-warning float-end">Logout</button>
        </div>
        </form> --}}
    </div>
</div>

@include('template/footer')