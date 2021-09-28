@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Two Factor Auth
                    </div>
                    <div class="card-header">
                        <strong>Your Code is : {{$code}}</strong>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('2fa.token') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="token" class="col-form-label">Token</label>
                                <input type="text" class="form-control @error('token') is-invalid @enderror" name="token" placeholder="enter your token">
                                @error('token')
                                   <span class="invalid-feedback">
                                       <strong>{{ $message }}</strong>
                                   </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Validate token</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
