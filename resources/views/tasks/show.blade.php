@extends('layouts.layout')

@php
    $nav = [
        "/tasks/show/$task->id" => 'Overview',
        "/tasks/show/$task->id/messages" => 'Add Messages',
        "/tasks/show/$task->id/assignees" => 'Assignees',
    ];
@endphp

@section('content')
    <x-banner h1="Task" span="Updation" />


    @can('isAdmin')
        <x-card-nav :nav=$nav></x-card-nav>
    @endcan

    @if (isset($request_status->is_accepted) && $request_status->is_accepted === 1)
        <x-card-nav :nav=$nav></x-card-nav>
    @endif


    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>



    <div class="content-wrapper">
        <div class="card card-lg">
            <form method="post" class="" method="post" action="{{ url('tasks/update', $task->id) }}">
                @csrf
                @method('post')

                <a class="flex justify-end gap-2 items-center text-sky-600 text-lg cursor-pointer" onclick="edit()"><i
                        class="fa-solid fa-pen"></i> Edit</a>

                <div class="flex flex-wrap gap-x-32">
                    <div class="w-2/5">
                        <span>
                            <label id="">Phone</label>
                            @error('phone')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                        <input id="phone" type="text" class="control hidden" name="phone"
                            value={{ $task->task_contact->phone }}>
                        <p class="text-lime-600 text-lg">{{ $task->task_contact->phone }}</p>
                    </div>

                    <div class="w-2/5">
                        <span>
                            <label id="">Email</label>
                            @error('email')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                        <input id="email" type="email" class="control hidden" name="email"
                            value={{ $task->task_contact->email }}>
                        <p class="control text-lime-600 text-lg">{{ $task->task_contact->email }}</p>
                    </div>

                    <div class="w-2/5">
                        <span>
                            <label id="">Secondary Phone</label>
                            @error('secondary_phone')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                        <input id="secondary_phone" type="text" class="control hidden" name="secondary_phone"
                            value={{ $task->task_contact->secondary_phone }}>
                        <p class="control text-lime-600 text-lg">{{ $task->task_contact->secondary_phone }}</p>
                    </div>

                    <div class="w-2/5">
                        <span>
                            <label id="">Secondary Email</label>
                            @error('secondary_email')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                        <input id="secondary_email" type="email" class="control hidden" name="secondary_email"
                            value={{ $task->task_contact->secondary_email }}>
                        <p class="control text-lime-600 text-lg">{{ $task->task_contact->secondary_email }}</p>
                    </div>

                    <div class="w-2/5">
                        <span>
                            <label id="">Status</label>
                            @error('status')
                                <p>{{ $status }}</p>
                            @enderror
                        </span>
                        <select class="control hidden" name="status" id="priority">
                            @foreach ($status as $val)
                                <option value="{{ $val }}" {{ $val == $task->status ? 'selected' : '' }}>
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                        <p class="control text-lime-600 text-lg">{{ $task->status }}</p>
                    </div>
                    <div class="w-2/5">
                        <span>
                            <label id="">Priority</label>
                            @error('priority')
                                <p>{{ $priority }}</p>
                            @enderror
                        </span>
                        <select class="control hidden" name="priority" id="priority">
                            @foreach ($priority as $val)
                                <option value="{{ $val }}" {{ $val == $task->priority ? 'selected' : '' }}>
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                        <p class="control text-lime-600 text-lg">{{ $task->priority }}</p>
                    </div>

                    <div class="w-2/5">
                        <span>
                            <label id="">City</label>
                            @error('city')
                                <p>{{ $city }}</p>
                            @enderror
                        </span>
                        <input id="city" type="text" class="control hidden" name="city"
                            value={{ $task->city }}>
                        <p class="control text-lime-600 text-lg">{{ $task->city }}</p>
                    </div>
                    <div class="w-2/5">
                        <span>
                            <label id="">State</label>
                            @error('state')
                                <p>{{ $state }}</p>
                            @enderror
                        </span>
                        <input id="state" type="text" class="control hidden" name="state"
                            value={{ $task->state }}>
                        <p class="control text-lime-600 text-lg">{{ $task->state }}</p>
                    </div>

                </div>

                <span>
                    <label id="">Address</label>
                    @error('address')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <textarea id="address" required="true" class="control hidden" name="address">{{ $task->task_contact->address }}</textarea>
                <p class="control text-lime-600 text-lg">{{ $task->task_contact->address }}</p>


                <span>
                    <label id="">Description*</label>
                    @error('description')
                        <p>{{ $message }}</p>
                    @enderror
                </span>
                <textarea id="description" required="true" class="control hidden" name="description">{{ $task->description }}</textarea>
                <p class="control text-lime-600 text-lg">{{ $task->description }}</p>


                <div class="btn-container">
                    <button type="submit" value="SUBMIT" class="btn bg-primary hidden">UPDATE
                    </button>
                </div>
            </form>

            @if ($request_status != null and ($request_status->is_accepted == 0 and $request_status->is_rejected == 0))
                <form class="btn-container gap-14" action="{{ url('assignees/update') }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="request_status" value="accept"
                        class="relative inline-flex items-center px-12 py-3 overflow-hidden text-lg font-medium text-lime-600 border-2 border-lime-600 rounded-full hover:text-white group hover:bg-gray-50 w-2/6">
                        <span
                            class="absolute left-0 block w-full h-0 transition-all bg-lime-600 opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
                        <span
                            class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <span class="relative mx-auto">Accept Request</span>
                    </button>

                    <button type="submit" name="request_status" value="reject"
                        class="relative inline-flex items-center px-12 py-3 overflow-hidden text-lg font-medium text-red-500 border-2 border-red-500 rounded-full hover:text-white group hover:bg-gray-50 w-2/6">
                        <span
                            class="absolute left-0 block w-full h-0 transition-all bg-red-500 opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
                        <span
                            class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <span class="relative mx-auto">Reject Request</span>
                    </button>
                </form>
            @endif
        </div>

    </div>
@endsection
