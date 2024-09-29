@include('template/header')

@if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session()->get('loginError')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

@if (session()->has('registerSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session()->get('registerSuccess')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

@if (session()->has('verified'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session()->get('verified')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

<body class="position-absolute top-50 start-50 translate-middle">
    <div class="container"></div>
        <div class="row justify-content-center">
                <div class="card border col-sm-6 col-md-4 col-md-offset-4" style="width: 25rem; height: 25rem;">
                    <div>
                        <h2 class="text-center my-4"><b>Login</b></h2>
                    </div>

                    <div class="card-body">

                        <form action="{{route('actionlogin')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            {{-- <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control mt-2" name="username" placeholder="Username" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="email" class="form-control mt-2" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="mt-3">Password</label>
                                <input type="password" class="form-control mt-2" name="password" placeholder="Password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary mt-3">Login</button>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{url('register-mahasiswa')}}" type="submit" class="btn btn-secondary mt-3">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>


@include('template/footer')
