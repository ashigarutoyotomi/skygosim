@extends('layouts.app')

@section('content')
    <header-comp
        title="Checkout"
    ></header-comp>

    @if($user)
        <checkout-internet-package
            :user="{{$user}}"
        ></checkout-internet-package>
    @else
        <checkout-internet-package></checkout-internet-package>
    @endif
@endsection
