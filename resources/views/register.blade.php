@include('template/header')

@if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session()->get('registerError')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

<body class="position-absolute top-50 start-50 translate-middle">
    <div class="container"></div>
        <div class="row justify-content-center">
                <div class="card border col-sm-6 col-md-4 col-md-offset-4" style="width: 25rem; height: 23rem;">
                    <div>
                        <h2 class="text-center my-4"><b>Register</b></h2>
                    </div>

                    <div class="card-body">

                        <form action="{{route('actionregister')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control mt-2" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password" class="mt-3">Password</label>
                                <input type="password" class="form-control mt-2" name="password" placeholder="Password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary mt-3">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>


@include('template/footer')
