@extends('layouts.layout')

@section('content')
    <main class="profile-page bg-secondary">
        <section class="py-40">
            <form class="flex justify-center container mx-auto px-4 text-black" method="post" enctype="multipart/form-data"
                action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('post')
                <div class=" flex flex-col min-w-0 break-words card w-11/12 mb-6 shadow-xl rounded-lg ">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="">

                                    @if (isset($user->image))
                                        <img alt="..." src="{{ asset($user->image) }}"
                                            class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-28 -ml-20 lg:-ml-16"
                                            style="max-width: 150px;" />
                                    @else
                                        <img alt="..." src="{{ asset('storage/profile.jfif') }}"
                                            class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-28 -ml-20 lg:-ml-16"
                                            style="max-width: 150px;" />
                                    @endif
                                </div>
                            </div>

                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0 flex justify-end gap-8">
                                    @if ($user->id == auth()->id())
                                        <a class="flex justify-end gap-2 items-center text-green-600 text-lg cursor-pointer"
                                            onclick="edit()"><i class="fa-solid fa-pen"></i> Edit</a>
                                    @endif

                                    @can('isAdmin')
                                        @if ($user->role_id == 3)
                                            @if ($request_status == null or $request_status->is_requested === 0)
                                                <a class="flex justify-end gap-2 items-center text-green-600 text-lg cursor-pointer"
                                                    onclick="submitForm()">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    Add to task
                                                </a>
                                            @endif
                                        @endif
                                    @endcan

                                    @can('isAdminOrEmergencyResponder')
                                        @if ($user->role_id == 4)
                                            @if ($request_status == null or $request_status->is_requested === 0)
                                                <a class="flex justify-end gap-2 items-center text-green-600 text-lg cursor-pointer"
                                                    onclick="submitForm()">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    Request Help
                                                </a>
                                            @elseif($request_status->is_requested == 1 && $request_status->is_accepted == 0 && $request_status->is_rejected == 0)
                                                <p
                                                    class="flex justify-end gap-2 items-center text-red-400 text-lg cursor-not-allowed">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    Request already sent!
                                                </p>
                                            @endif
                                        @endif
                                    @endcan

                                </div>
                            </div>

                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                {{-- <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-gray-700">22</span><span
                                            class="text-sm text-gray-500">Friends</span>
                                    </div>
                                    <div class="mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-gray-700">10</span><span
                                            class="text-sm text-gray-500">Photos</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-gray-700">89</span><span
                                            class="text-sm text-gray-500">Comments</span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center text-center mt-4">
                            <div
                                class="w-2/5 flex justify-center items-center text-sm leading-normal mt-2 mb-3 text-gray-500 font-bold">
                                <i class="fa-solid fa-user mr-2 text-lg text-emerald-700"></i>
                                <p class="text-xl font-semibold text-emerald-600">{{ $user->name }}</p>
                                @error('name')
                                    <p>{{ $message }}</p>
                                @enderror
                                <input id="name" type="text" class="w-3 control hidden" name="name"
                                    value="{{ $user->name }}">
                            </div>

                            <div
                                class="w-2/5 flex justify-center items-center text-lg leading-normal mt-2 mb-3 text-gray-500">
                                <i class="fa-solid fa-at mr-2 text-emerald-700"></i>
                                <p class="text-emerald-600">{{ $user->email }}</p>
                                @error('email')
                                    <p>{{ $message }}</p>
                                @enderror
                                <input id="email" type="email" class="w-3 control hidden" name="email"
                                    value="{{ $user->email }}">
                            </div>

                            <div
                                class="w-2/5 flex justify-center items-center text-sm leading-normal mt-2 mb-3 text-gray-500 font-bold">
                                <i class="fa-solid fa-camera mr-2 text-lg text-emerald-700 hidden"></i>
                                <input id="image" type="file" class="w-3 control hidden" name="image">
                            </div>



                            @if ($user->role_id == 4)
                                <div class="flex justify-between items-center mt-9 text-lg">
                                    <span class="text-emerald-600 pr-2">Skills</span>

                                    @foreach ($volunteer_skills as $v_skill)
                                        <p
                                            class="bg-emerald-100 text-emerald-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-emerald-200 dark:text-emerald-800 mr-2">

                                            {{ $v_skill->skill }}
                                        </p>
                                    @endforeach

                                </div>

                                <div class="hidden justify-between items-center mt-9 w-full" id="multi-select">
                                    <select name="skills[]" id="skills" multiple multiselect-search="true"
                                        class="">
                                        @foreach ($skills as $skill)
                                            @if (count($volunteer_skills) != 0)
                                                @foreach ($volunteer_skills as $index => $v_skill)
                                                    {{-- If skills match, they will be selected --}}
                                                    @if ($v_skill->skill == $skill)
                                                        <option value="{{ $skill }}" selected>{{ $skill }}
                                                        </option>
                                                    @break

                                                    {{-- If not, checks if its last index and show. Otherwise duplicates may arise --}}
                                                @elseif ($index == array_key_last($volunteer_skills->toArray()))
                                                    <option value="{{ $skill }}">{{ $skill }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ $skill }}">{{ $skill }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        @endif

                        <div class="btn-container">
                            <button type="submit" value="SUBMIT" class="btn bg-primary hidden">UPDATE
                            </button>
                        </div>


                    </div>
                    <div class="mt-10 py-10 border-t border-gray-300 text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-9/12 px-4">
                                <div class="mb-4 text-lg leading-relaxed text-gray-800">
                                    In the aftermath of a disaster, your community needs your help! Whether it's
                                    assisting residents with clearing debris from their homes, helping to assess the
                                    needs of those affected, or offering emotional support to those struggling, your
                                    willingness to lend a hand is invaluable.
                                </div>
                                {{-- <a href="#pablo" class="font-normal text-emerald-500">Show more</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </section>
</main>
{{-- Form for requesting help --}}
<form action="{{ route('request_help', $user->id) }}" method="post" id="secondForm">
    @csrf
</form>
@endsection
