@extends('layouts.setting')

@section('content')
    @include('setting.page.uom')

    @include('setting.page.currency')

    @include('setting.page.size')
    
    @include('setting.page.payment-method')

@endsection