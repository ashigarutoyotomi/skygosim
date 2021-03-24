@extends('layouts.app')

@section('content')
    <header-comp
        title="Checkout"
    ></header-comp>

    @if($type === 'buyInternetPackage')
        @if($user)
            <checkout-form
                :user="{{$user}}"
            ></checkout-form>
        @else
            <checkout-form></checkout-form>
        @endif
    @elseif($type === 'buyPhysicalSim')
        @if($user)
            <checkout-e-sim-form
                :user="{{$user}}"
            ></checkout-e-sim-form>
        @else
            <checkout-e-sim-form></checkout-e-sim-form>
        @endif
    @elseif($type === 'buyESim')
        @if($user)
            <checkout-e-sim-form
                :user="{{$user}}"
            ></checkout-e-sim-form>
        @else
            <checkout-e-sim-form></checkout-e-sim-form>
        @endif
    @endif
@endsection
