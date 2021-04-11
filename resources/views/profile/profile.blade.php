@extends('layouts.app')

@section('content')
    <header-comp
        title="Profile"
    ></header-comp>

    <profile-index
        :user="{{$user}}"
    ></profile-index>
@endsection
