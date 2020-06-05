@extends('layouts.app')

@section('content')
<div class="container">
    <div id="ranking">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('custom.player') }}</th>
                        <th scope="col">{{ __('custom.town_name') }}</th>
                        <th scope="col">{{ __('custom.score') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection