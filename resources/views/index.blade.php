@extends('layout.app')

@section('content')
    @isset($login)
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-9 col-10 mx-auto my-5 mt-5">
            <div style="font-size: 1.7rem" class="text-lead font-weight-bold my-3">
                Login
            </div>
            <form action="/login_user" method="POST">
                @csrf
                @if (count($errors) > 0)
                    <div class="error-msg p-3">
                        <div class="per-error">
                            {{ $errors->first('username') }}
                        </div>
                        <div class="per-error">
                            {{ $errors->first('password') }}
                        </div>
                        <div class="per-error">
                            {{ $errors->first('login') }}
                        </div>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="username" class="form-label">User Name</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn px-5 btn-dark">Login</button>
                </div>

                <div class="upgrade mt-3">
                    Don't Have An Account ? <a href="{{ URL::to('/register') }}">Register</a>
                </div>
            </form>
        </div>
    @endisset


    @isset($register)
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-9 col-10 mx-auto my-5 mt-5">
            <div style="font-size: 1.7rem" class="text-lead font-weight-bold my-3">
                Register
            </div>
            <form action="/create_user" method="POST">
                @csrf
                @if (count($errors) > 0)
                    <div class="error-msg p-3">
                        <div class="per-error">
                            {{ $errors->first('fullname') }}
                        </div>
                        <div class="per-error">
                            {{ $errors->first('username') }}
                        </div>
                        <div class="per-error">
                            {{ $errors->first('password') }}
                        </div>
                        <div class="per-error">
                            {{ $errors->first('email') }}
                        </div>
                        <div class="per-error">
                            {{ $errors->first('user_type') }}
                        </div>
                    </div>
                @endif


                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="row">
                    <label for="password" class="form-label">User Type</label>
                    <div class="col-3 mb-3 pl-3 form-check">
                        {{-- Admin --}}
                        <input type="radio" class="form-check-input ml-3" name="user_type" id="adminCheck" value="admin"
                            id="adminCheck" required>
                        <label class="form-check-label" for="adminCheck">Admin</label>
                    </div>


                    <div class="col-3 mb-3 form-check">
                        {{-- User --}}
                        <input type="radio" class="form-check-input" name="user_type" value="user" id="freeUserCheck"
                            required>
                        <label class="form-check-label" for="freeUserCheck"> User</label>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn my-3 px-5 btn-dark">Register</button>
                </div>

                <div class="upgrade mt-3">
                    Already Have An Account ? <a href="{{ URL::to('/login') }}">Login</a>
                </div>
            </form>
        </div>
    @endisset

    @isset($index)
        <div class="text-muted user-type display-4 mt-5">
            HOMEPAGE
            <div class="upgrade mt-3">
                <a href="{{ URL::to('/login')}}">Login</a> <span style="font-size: 1rem !important">|</span> <a href="{{ URL::to('/register')}}">Register</a>
            </div>

        </div>
    @endisset
@endsection
