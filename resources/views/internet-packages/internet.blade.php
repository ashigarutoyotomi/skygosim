@extends('layouts.app')

@section('content')
    <internet-packages-index></internet-packages-index>

{{--    <header-comp--}}
{{--        title="Packages"--}}
{{--    ></header-comp>--}}

{{--    @if($user)--}}
{{--        <internet-packages--}}
{{--            :user="{{$user}}"--}}
{{--            :internet-packages="{{$internetPackages}}"--}}
{{--        ></internet-packages>--}}
{{--    @else--}}
{{--        <internet-packages--}}
{{--            :internet-packages="{{$internetPackages}}"--}}
{{--        ></internet-packages>--}}
{{--    @endif--}}
@endsection
