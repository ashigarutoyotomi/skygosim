@extends('layouts.app')

@section('content')
    <header-comp
        title="Order Physical Sim"
    ></header-comp>

    @if($user)
        <checkout-physical-sim-form
            :user="{{$user}}"
        ></checkout-physical-sim-form>
    @else
        <checkout-physical-sim-form></checkout-physical-sim-form>
    @endif

@endsection
