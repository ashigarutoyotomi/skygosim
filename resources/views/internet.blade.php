@extends('layouts.app')

@section('content')
    <header-comp
        title="Internet"
    ></header-comp>

    <internet-packages
        :internet-packages="{{$internetPackages}}"
    ></internet-packages>
@endsection
