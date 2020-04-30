@extends('layouts.app')

@section('content')
<div id="town_name">{{ Auth::user()->town->name }}</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 main-game">
            <div class="card">
                <div class="resources">
                    <span id="amount_food">{{ __('custom.food') }}: {{ Auth::user()->town->food }}</span>
                    <span id="amount_wood">{{ __('custom.wood') }}: {{ Auth::user()->town->wood }}</span>
                    <span id="amount_stone">{{ __('custom.stone') }}: {{ Auth::user()->town->stone }}</span>
                    <span id="amount_gold">{{ __('custom.gold') }}: {{ Auth::user()->town->gold }}</span>
                </div>
                <div id="woodsman_hut">WOODSMAN</div>
                <div id="mine">MINE</div>
                <div id="townhall">TOWNHALL</div>
                <div id="fisherman">FISHERMAN</div>
                <div id="potion_shop">POTIONSHOP</div>
                <div id="farmhouse">FARMHOUSE</div>
                <div id="merchant">MERCHANT</div>
            </div>
        </div>
    </div>
</div>
@endsection