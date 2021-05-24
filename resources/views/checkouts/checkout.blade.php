@extends('layouts.app')

@section('content')
    <checkout-index
        :order="{{$order}}"
    ></checkout-index>
@endsection
