@props(['tasks'])

@unless (count($tasks) == 0)
    @foreach ($tasks as $task)
        <div class="card w-2/3">
            <h2>Please Verify</h2>
            <div class="card__highlight">

                <div class="card__highlight-item">
                    <div class="item-icon">
                        <i class="fa-solid fa-chart-line"></i>
                        STATUS
                    </div>
                    <div>
                        {{ $task->status }}
                    </div>
                </div>

                <div class="card__highlight-item">
                    <div class="item-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        PRIORITY
                    </div>
                    <div>
                        {{ $task->priority }}
                    </div>
                </div>

                <div class="card__highlight-item">
                    <div class="item-icon">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        CITY
                    </div>
                    <div>
                        {{ $task->city }}
                    </div>
                </div>

                <div class="card__highlight-item">
                    <div class="item-icon">
                        <i class="fa-solid fa-earth-asia"></i>
                        REGION
                    </div>
                    <div>
                        {{ $task->state }}
                    </div>
                </div>
            </div>

            <div class="timeline">
                <div class="timeline__middle">
                    <div class="timeline__point"></div>
                </div>
                <div class="timeline__content">
                    <p class="timeline__info">You reported danger.</p>
                    <p class="timeline__time">{{ $task->created_at }}</p>
                </div>

                <div class="timeline__middle">
                    <div class="timeline__point"></div>
                </div>
                <div class="timeline__content">
                    <p class="timeline__info">We've automatically filled in your location. Please
                        confirm if this is the correct address.</p>
                    <p class="timeline__time">{{ $task->created_at }}</p>
                </div>
            </div>

            <div class="last-item">
                <a href="/tasks/destroy/{{ $task->id }}" class="btn bg-primary">Delete</a>
                <a href="/tasks/show/{{ $task->id }}" class="btn bg-green-light">View More</a>
            </div>

        </div>
    @endforeach
@else
    <p>No tasks</p>
@endunless
