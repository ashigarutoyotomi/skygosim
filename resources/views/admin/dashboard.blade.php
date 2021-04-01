@extends('layouts.admin')

@section('content')
    <admin
        :user="{{Auth::user()}}"
    ></admin>
@endsection
