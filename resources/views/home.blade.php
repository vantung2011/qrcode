@extends('layouts.app')
@section('content')
    @auth
        {{ $admin = 1 }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            @if (Auth::user()->role_id == $admin)
                                {{ redirect('/home') }}
                            @else
                                User Dashboard
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
