@extends('layouts.app')

@section('content')
<div id="town_name">{{ Auth::user()->town->name }}</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 main-game">

                <div class="resources">
                    <span id="amount_food">{{ __('custom.food') }}: {{ Auth::user()->town->food }}</span>
                    <span id="amount_wood">{{ __('custom.wood') }}: {{ Auth::user()->town->wood }}</span>
                    <span id="amount_stone">{{ __('custom.stone') }}: {{ Auth::user()->town->stone }}</span>
                    <span id="amount_gold">{{ __('custom.gold') }}: {{ Auth::user()->town->gold }}</span>
                </div>

                <div class="building" id="woodsman_hut">WOODSMAN</div>
                <div class="nametag" id="nametag_woodsman">WOODSMAN HUT</div>

                <div class="building" id="mine">MINE</div>
                <div class="nametag" id="nametag_mine">MINE</div>

                <div class="building" id="townhall">TOWNHALL</div>
                <div class="nametag" id="nametag_TH">TOWN HALL</div>

                <div class="building" id="fisherman">FISHERMAN</div>
                <div class="nametag" id="nametag_fisherman">FISHERMAN CABIN</div>

                <div class="building" id="potion_shop">POTIONSHOP</div>
                <div class="nametag" id="nametag_potion">POTION SHOP</div>

                <div class="building" id="farmhouse">FARMHOUSE</div>
                <div class="nametag" id="nametag_farmhouse">FARMHOUSE</div>

                <div class="building" id="merchant">MERCHANT</div>
                <div class="nametag" id="nametag_merchant">MERCHANT</div>


                <div class="slide" id="slide">
                    Name: <span id="buildingname"></span><br>
                    Level:<span id="buildinglevel"></span><br>
                    Power:<span id="buildingpower"></span><br>
                    <hr>
                    NextLevel: <span id="upgradelevel"></span><br>
                    Food: <span id="foodcost"></span><br>
                    Wood: <span id="woodcost"></span><br>
                    Stone: <span id="stonecost"></span><br>
                    Gold: <span id="goldcost"></span><br>
                    Town Hall level: <span id="threq"></span><br>
                    Upgrade Time: <span id="upgradetime"></span><br>

                    <button>UPGRADE</button>
                </div>

        </div>
    </div>
</div>
@endsection