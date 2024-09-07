@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center">Đăng ký tài khoản</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger text-center">Đã có lỗi, vui lòng kiểm tra lại dữ liệu</div>
                        @endif
                        <div>
                            <label for="name" class="form-label">Tên</label>
                            <input id="name" type="text" class="shadow-sm rounded-pill form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ Email</label>
                            <input id="email" type="text" class="shadow-sm rounded-pill form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input id="username" type="text" class="shadow-sm rounded-pill form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input id="password" type="password" class="shadow-sm rounded-pill form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Nhập lại mật khẩu</label>
                            <input id="password-confirm" type="password" class="shadow-sm rounded-pill form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" style="background: #57b846" class="shadow-sm rounded-pill btn btn-success w-100">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
