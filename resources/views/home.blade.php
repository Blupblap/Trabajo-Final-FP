@extends('layouts.app')

@section('content')
<div id="town_name">
    <h2>{{ Auth::user()->town->name }}</h2>
</div>
<div class="container">
    <div id="resources" class="mt-2 py-1 px-3 font-weight-bold">
        <span>{{ __('custom.food') }}: <span id="amount_food"></span></span>
        <span>{{ __('custom.wood') }}: <span id="amount_wood"></span></span>
        <span>{{ __('custom.stone') }}: <span id="amount_stone"></span></span>
        <span>{{ __('custom.gold') }}: <span id="amount_gold"></span></span>
    </div>
    <div id="main-game">
        <div class="nametag"></div>

        <div class="modal fade" id="building_info" tabindex="-1" role="dialog" aria-labelledby="building_info_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-dark">
                        <h5 class="modal-title font-weight-bold" id="building_info_title">
                            <span id="info_name"></span> ({{ __('custom.level') }} <span id="info_level"></span>)
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row py-1">
                            <div class="col-5">
                                {{ __('custom.power') }}: <span id="info_power"></span>
                            </div>
                            <div id="info_resources" class="col-7">
                                <div>{{ __('custom.food_min') }}: <span id="food_per_minute"></span></div>
                                <div>{{ __('custom.wood_min') }}: <span id="wood_per_minute"></span></div>
                                <div>{{ __('custom.stone_min') }}: <span id="stone_per_minute"></span></div>
                                <div>{{ __('custom.gold_min') }}: <span id="gold_per_minute"></span></div>
                            </div>
                        </div>
                        <div id="next_level">
                            <div class="row border-top border-dark">
                                <div class="col-12">
                                    <div class="row py-1">
                                        <div class="col-12 text-center font-weight-bold">
                                            {{ __('custom.next_level') }}
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-5">
                                            {{ __('custom.food') }}: <span id="food_cost"></span><br>
                                            {{ __('custom.wood') }}: <span id="wood_cost"></span><br>
                                            {{ __('custom.stone') }}: <span id="stone_cost"></span><br>
                                            {{ __('custom.gold') }}: <span id="gold_cost"></span>
                                        </div>
                                        <div class="col-7">
                                            {{ __('custom.th_level') }}: <span id="th_req"></span><br>
                                            {{ __('custom.construction_duration') }}: <span id="construction_duration"></span><br>
                                            <span id="time_left_container">{{ __('custom.time_left') }}: <span id="time_left"></span><span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-dark">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('custom.close') }}</button>
                        <button type="button" class="btn btn-primary" id="upgrade_button">{{ __('custom.build') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection