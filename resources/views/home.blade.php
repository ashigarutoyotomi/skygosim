@extends('layouts.app')

@section('content')
    <header-slider></header-slider>

    <internet-packages
        :internet-packages="{{$internetPackages}}"
    ></internet-packages>

@endsection
