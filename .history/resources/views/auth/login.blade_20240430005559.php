@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Đăng nhập</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger text-center">Đã có lỗi, vui lòng kiểm tra lại dữ liệu</div>
                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label shadow">Tên đăng nhập</label>
                            <input id="email" type="text" class=" rounded-pill form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="email" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input id="password" type="password" class="rounded-pill form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ghi nhớ mật khẩu</label>
                        </div>
                        <button type="submit" style="background: #57b846" class="rounded-pill btn btn-success w-100">{{ __('Login') }}</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link mt-3 d-block text-center" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
