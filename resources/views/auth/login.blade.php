@extends('layouts.login')

@section('content')
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" filter-color="black" data-image="../../assets/img/grande-login.png">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        @foreach ($errors->all() as $error)
                        <div class="card card-login card-hidden alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $error }}</strong>
                        </div>
                        @endforeach
                        <form method="POST" action="{{ route('auth_login') }}">
                            @csrf
                            <div class="card card-login card-hidden">
                                <div class="card-header text-center" data-background-color="green">
                                    <h4 class="card-title">Login</h4>
                                </div>
                                <p class="category text-center">
                                    Masukkan Email dan Password
                                </p>
                                <div class="card-content">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Masukkan Email</label>
                                            <input name="room" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Masukkan Password</label>
                                            <input name="password" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="https://grandegardencafe.com">
                                Grande Garden Cafe
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="https://grandegardencafe.com">Grande Garden Cafe</a>, Cafe rasa liburan
                </p>
            </div>
        </footer>
    </div>
</div>
@endsection