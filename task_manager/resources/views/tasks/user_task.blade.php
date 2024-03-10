@forelse ($tasks as $task)
    <li>{{ $task->title }}</li>
    <li>{{ $task->description }}</li>
    <li>{{ $task->status }}</li>
    <hr>
@empty
    <p>No tasks available</p>
@endforelse