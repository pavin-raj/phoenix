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

    <div>
        <div class="content-wrapper">
            <form method="post" class="card w-6/12 my-9" action="{{ route('messages.store', $task_id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="flex flex-row items-center gap-x-2 text-green-600">
                    <label for="file">
                        <i class="fa-solid fa-paperclip"></i>
                        <input type="file" id="file" name="file" class="hidden">
                    </label>
                    <input type="text" name="body" id="body">
                    <button type="submit"
                        class="fa-regular fa-paper-plane text-white bg-green-600 p-4 rounded-md"></button>
            </form>
        </div>
    </div>

    @unless (count($messages) == 0)
        <div class="content-wrapper">
            <div>
                @foreach ($messages as $message)
                    <div class="flex w-full">
                        <div class="bg-green-500 w-1"></div>
                        <div class="w-24 h-20 mx-4 bg-green-500 rounded-full">
                        </div>
                        <div class="flex flex-col w-full justify-around">
                            <p class="text-green-500 font-bold text-lg">{{ $message->user->name }}</p>
                            <p class="text-gray-400">Posted on {{ $message->created_at }}</p>
                            <p class="text-slate-700 pb-10">{{ $message->body }}</p>
                            @if (isset($message->file))
                                <img src="{{ asset($message->file) }}" alt="file" class="w-7/12 h-4/5 pb-10">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endunless


@endsection
