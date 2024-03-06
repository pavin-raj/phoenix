@props(['nav'])


<div class="content-wrapper">
    @foreach ($nav as $link => $title)
        <a class="card card-sm card-hover" href="{{ $link }}">
        <div class="card__title">
            <i class="fa-solid fa-layer-group"></i>
            {{ $title }}
        </div>
    </a>
    @endforeach
</div>
