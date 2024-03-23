@extends('layouts.layout')

@section('content')
    <main class="profile-page bg-secondary">
        <section class="py-40">
            <div class="flex justify-center container mx-auto px-4">
                <div class=" flex flex-col min-w-0 break-words card w-11/12 mb-6 shadow-xl rounded-lg ">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="">
                                    <img alt="..."
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Outdoors-man-portrait_%28cropped%29.jpg/330px-Outdoors-man-portrait_%28cropped%29.jpg"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-28 -ml-20 lg:-ml-16"
                                        style="max-width: 150px;" />
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    <a class="flex justify-end gap-2 items-center text-green-600 text-lg cursor-pointer"
                                        onclick="edit()"><i class="fa-solid fa-pen"></i> Edit</a>
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

                            {{-- <p class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2">
                                {{ $user->name }}
                            </p>
                            <input id="name" type="text" class="control hidden" name="name"
                                value="{{ $user->name }}"> --}}

                            <div
                                class="w-2/5 flex justify-center items-center text-sm leading-normal mt-2 mb-3 text-gray-500 font-bold">
                                <i class="fa-solid fa-user mr-2 text-lg text-emerald-700"></i>
                                <p class="text-xl font-semibold text-emerald-600">{{ $user->name }}</p>
                                <input id="name" type="text" class="w-3 control hidden" name="name"
                                    value="{{ $user->name }}">
                            </div>

                            <div
                                class="w-2/5 flex justify-center items-center text-lg leading-normal mt-2 mb-3 text-gray-500">
                                <i class="fa-solid fa-at mr-2 text-emerald-700"></i>
                                <p class="text-emerald-600">{{ $user->email }}</p>
                                <input id="email" type="email" class="w-3 control hidden" name="email"
                                    value="{{ $user->email }}">
                            </div>

                            
                        </div>
                        <div class="mt-10 py-10 border-t border-gray-300 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <p class="mb-4 text-lg leading-relaxed text-gray-800">
                                        An artist of considerable range, Jenna the name taken by
                                        Melbourne-raised, Brooklyn-based Nick Murphy writes,
                                        performs and records all of his own music, giving it a
                                        warm, intimate feel with a solid groove structure. An
                                        artist of considerable range.
                                    </p>
                                    <a href="#pablo" class="font-normal text-emerald-500">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script>
        function toggleNavbar(collapseID) {
            document.getElementById(collapseID).classList.toggle("hidden");
            document.getElementById(collapseID).classList.toggle("block");
        }
    </script>

    </html>
@endsection
