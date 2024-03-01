@extends('layouts.layout')

@php
    $h1 = auth()->check() ? 'Welcome' : 'Report Danger';
    $span = auth()->check() ? auth()->user()->name : 'Now';
@endphp
@section('content')
    <x-banner :h1=$h1 :span=$span />
@endsection
