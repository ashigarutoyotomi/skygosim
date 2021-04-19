@extends('layouts.app')

@section('content')
    <header-comp
        title="Packages"
    ></header-comp>

    <internet-packages
        :internet-packages="{{$internetPackages}}"
    ></internet-packages>
@endsection
