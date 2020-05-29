@extends('layouts.app')

@section('content')
<div id="town_name">
    <h2>{{ Auth::user()->town->name }}</h2>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 main-game">

            <div class="resources mt-2 py-1 px-3 font-weight-bold">
                <span>{{ __('custom.food') }}: <span id="amount_food"></span></span>
                <span>{{ __('custom.wood') }}: <span id="amount_wood"></span></span>
                <span>{{ __('custom.stone') }}: <span id="amount_stone"></span></span>
                <span>{{ __('custom.gold') }}: <span id="amount_gold"></span></span>
            </div>

            <div class="nametag"></div>

            <div id="building_info" class="border border-dark py-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5>
                            <span id="info_name"></span> ({{ __('custom.level') }} <span id="info_level"></span>)<br>
                        </h5>
                    </div>
                </div>
                <div class="row border-top border-dark py-1">
                    <div class="col-5">
                        {{ __('custom.power') }}: <span id="info_power"></span>
                    </div>
                    <div id="info_resources" class="col-7">
                        <div>Food/min: <span id="food_per_minute"></span></div>
                        <div>Wood/min: <span id="wood_per_minute"></span></div>
                        <div>Stone/min: <span id="stone_per_minute"></span></div>
                        <div>Gold/min: <span id="gold_per_minute"></span></div>
                    </div>
                </div>
                <div id="next_level">
                    <div class="row border-top border-dark">
                        <div class="col-12">
                            <div class="row py-1">
                                <div class="col-12 text-center">
                                    {{ __('custom.next_level') }}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-6">
                                    {{ __('custom.food') }}: <span id="food_cost"></span><br>
                                    {{ __('custom.wood') }}: <span id="wood_cost"></span><br>
                                    {{ __('custom.stone') }}: <span id="stone_cost"></span><br>
                                    {{ __('custom.gold') }}: <span id="gold_cost"></span>
                                </div>
                                <div class="col-6">
                                    {{ __('custom.th_level') }}: <span id="th_req"></span><br>
                                    {{ __('custom.construction_duration') }}: <span id="construction_duration"></span>
                                    <span id="time_left_container">{{ __('custom.time_left') }}: <span id="time_left"></span><span>
                                </div>
                            </div>
                            <div class="row pt-2 justify-content-end">
                                <div class="col-12">
                                    <button id="upgrade_button">{{ __('custom.build') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="game_alert" class="alert alert-dismissible text-center" data-default-error="{{ __('custom.errorDefault') }}">
</div>
@endsection