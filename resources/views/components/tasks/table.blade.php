@props(['tasks'])



@unless (count($tasks) == 0)
    <table class="text-slate-50">
        <tr class="bg-emerald-950">
            <th class="text-center">Issue</th>
            <th>Owner</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Place</th>
            <th>Action</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td class="w-96 text-slate-200">{{ $task->description }}</td>
                <td>{{ $task->user_id }}</td>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->city }}</td>
                <td><a href="{{ url('/tasks/show/'.$task->id) }}"
                        class="btn bg-zinc-50 text-2xl text-green-400 font-bold">View Details</a></td>
            </tr>
        @endforeach
    </table>
@endunless
