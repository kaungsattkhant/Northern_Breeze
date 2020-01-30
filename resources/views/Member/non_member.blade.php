@extends('Layouts.master')
@section('content')
    @php
      $is_admin=\Illuminate\Support\Facades\Auth::user()->isAdmin()
    @endphp
    <non-member is_admin="{{$is_admin}}" currencies="{{$currencies}}"></non-member>
@endsection

