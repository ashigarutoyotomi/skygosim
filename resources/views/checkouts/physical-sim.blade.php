@extends('layouts.app')

@section('content')
    <header-comp
        title="Order Physical Sim"
    ></header-comp>

    @if($user)
        <checkout-physical-sim-form
            :user="{{$user}}"
            :order-price="{{$orderPrice}}"
            :shipping-price="{{$shippingPrice}}"
        ></checkout-physical-sim-form>
    @else
        <checkout-physical-sim-form
            :order-price="{{$orderPrice}}"
            :shipping-price="{{$shippingPrice}}"
        ></checkout-physical-sim-form>
    @endif

@endsection
