@extends('layouts.app')

@section('content')
    <apn-index
        :regions="{{$regions}}"
    ></apn-index>
@endsection
