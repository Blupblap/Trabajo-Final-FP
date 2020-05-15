@extends('layouts.app')

@section('content')
<div id="town_name">{{ Auth::user()->town->name }}</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 main-game">

            <div class="resources">
                {{ __('custom.food') }}: <span id="amount_food"></span>
                {{ __('custom.wood') }}: <span id="amount_wood"></span>
                {{ __('custom.stone') }}: <span id="amount_stone"></span>
                {{ __('custom.gold') }}: <span id="amount_gold"></span>
            </div>

            <div class="nametag"></div>

            <div id="building_info">
                {{ __('custom.name') }}: <span id="info_name"></span><br>
                {{ __('custom.level') }}: <span id="info_level"></span><br>
                {{ __('custom.power') }}: <span id="info_power"></span><br>
                <hr>
                {{ __('custom.next_level') }}: <span id="upgrade_level"></span><br>
                {{ __('custom.food') }}: <span id="food_cost"></span><br>
                {{ __('custom.wood') }}: <span id="wood_cost"></span><br>
                {{ __('custom.stone') }}: <span id="stone_cost"></span><br>
                {{ __('custom.gold') }}: <span id="gold_cost"></span><br>
                {{ __('custom.th_level') }}: <span id="th_req"></span><br>
                {{ __('custom.construction_duration') }}: <span id="construction_duration"></span><br>

                <button>{{ __('custom.build') }}</button>
            </div>

        </div>
    </div>
</div>
@endsection