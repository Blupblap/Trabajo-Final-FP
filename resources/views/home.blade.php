@extends('layouts.app')

@section('content')
<div id="town_name">TOWN NAME</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 main-game">
            <div class="card">
                <div class="resources">
                    <span id="amount_wood">Wood: xxx</span> 
                    <span id="amount_stone">Stone: xxx</span> 
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
