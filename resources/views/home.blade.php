@extends('layouts.app')

@section('content')
    <home-index
        :internet-packages="{{$internetPackages}}"
    ></home-index>
@endsection
