@extends('layouts.layout')

@php
    $nav = [
        "/tasks/show/$task_id" => 'Overview',
        "/tasks/show/$task_id/messages" => 'Add Messages',
        "/tasks/show/$task_id/assignees" => 'Assignees',
    ];
@endphp

@section('content')
    <x-banner h1="Task" span="Updation" />



    <x-card-nav :nav=$nav></x-card-nav>



    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    @unless (count($users) == 0)
        <table class="text-slate-50">
            <tr class="bg-emerald-950">
                <th class="text-center">Name</th>
                <th>Email</th>
            </tr>
            @foreach ($users as $user)
                @foreach ($user as $u)
                    <tr>
                        <td class="w-96 text-slate-200">{{ $u["name"] }}</td>
                        <td>{{ $u['email'] }}</td>
                    </tr>
                @endforeach
            @endforeach
            {{-- @php
    foreach ($users as $user) {
        echo $user;
    }
@endphp --}}
        </table>
    @endunless


@endsection
