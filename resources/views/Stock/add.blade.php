@extends('Layouts.master')
@section('content')

    <add-stock-inventory is_admin="{{$is_admin}}" currencies="{{$currencies}}" branches="{{$branches}}" total_value="{{$branch_total_value}}"></add-stock-inventory>

@endsection
