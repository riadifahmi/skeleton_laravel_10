@include('template/header')


<body>
    <div class="container mt-5">
        <h1 class="text-center my-4">Form Data Mahasiswa</h1>

            <form action="{{url('update',$nrp)}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nrp" class="mb-2">NRP</label>
                    <input type="text" class="form-control mb-3" name="nrp" placeholder="Masukkan NRP" value="{{$nrp}}" readonly required>
                </div>

                <div class="form-group">
                    <label for="nama" class="mb-2">Nama</label>
                    <input type="text" class="form-control mb-3" name="nama" placeholder="Masukkan Nama" value="{{$nama}}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="mb-2">Email</label>
                    <input type="email" class="form-control mb-3" name="email" placeholder="name@example.com" value="{{$email}}" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

@include('template/footer')