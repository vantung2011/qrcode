@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Đặt lại mật khẩu</h2>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ Email</label>
                            <input id="email" type="text" class="shadow-sm rounded-pill form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input id="password" type="password" class="shadow-sm rounded-pill form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Nhập lại mật khẩu mới</label>
                            <input id="password-confirm" type="password" class="shadow-sm rounded-pill form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <button type="submit" style="background: #57b846" class="shadow-sm rounded-pill btn btn-success w-100">Đặt lại mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
