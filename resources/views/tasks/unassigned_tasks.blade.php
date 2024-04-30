@extends('layouts.layout')

@php
    $nav = ['/tasks/index' => 'All Tasks', '/tasks/unassigned' => 'Unassigned Tasks', '/tasks/assigned' => 'Assigned Tasks'];
@endphp


@section('content')
    <x-banner h1="Open Requests" span=""></x-banner>

    <x-card-nav :nav=$nav></x-card-nav>

    <div class="content-wrapper">
        @if (count($unassigned_tasks) == 0)
            No unassigned tasks!
        @else
            <x-tasks.table :tasks=$unassigned_tasks></x-tasks.table>
        @endif
    </div>
@endsection
