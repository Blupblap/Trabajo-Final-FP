@extends('layouts.app')

@section('content')
<div class="container login-register">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('custom.choose_town_name') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('town_name') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('custom.town_name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" maxlength="20" required autofocus>

                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('custom.confirm') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection