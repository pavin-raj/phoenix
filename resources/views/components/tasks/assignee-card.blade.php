@props(['a'])


<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4 bg-red-100 rounded shadow-lg flex flex-col items-center">

    @if (isset($a['image']))
        <img class="w-44 h-44 rounded-full mb-4 object-cover mx-auto" src="{{ asset($a['image']) }}" alt="Assignee Image">
    @else
        <img class="w-44 h-44 rounded-full mb-4 object-cover mx-auto" src="{{ asset('storage/profile.jfif') }}"
            alt="Assignee Image">
    @endif



    <h3 class="mb-2 text-emerald-800 font-extrabold tracking-tight leading-none ">
        {{ $a['name'] }}
    </h3>
    <p class="text-green-700 text-sm mb-2">{{ $a['email'] }}</p>
    <a href="/users/show/{{ $a['id'] }}"
        class="relative rounded px-5 py-2.5 overflow-hidden group bg-green-500 relative hover:bg-gradient-to-r hover:from-green-500 hover:to-green-400 text-white hover:ring-2 hover:ring-offset-2 hover:ring-green-400 transition-all ease-out duration-300">
        <span
            class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
        <span class="relative">Show Details</span>
    </a>
</div>
