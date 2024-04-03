@props(['task_id'])

<ul class="border-r-2 border-green-200 w-56 left-16 ml-20 pr-5 h-40 text-emerald-500">
    <li class="mb-4"><a href="/tasks/show/{{ $task_id }}/assignees">All Assignees</a></li>
    <li class="mb-4"><a href="/tasks/show/{{ $task_id }}/emergency_responders">Emergency Responders</a></li>
    <li class="mb-4"><a href="/tasks/show/{{ $task_id }}/volunteers">Volunteers</a></li>
    <li class="mb-4"><a href="/tasks/show/{{ $task_id }}/assignable_users">Request Help</a></li>
</ul>
