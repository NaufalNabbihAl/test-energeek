<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">To-Do List</h1>
        <a href="{{ route('todo.create') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Task</button>
        </a>
        <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($tasks as $task)
                    @if ($task->user )
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3">{{ $task->user->name }}</td>
                            <td class="px-4 py-3">{{ $task->description }}</td>
                            <td class="px-4 py-3">{{ $task->categorie ? $task->categorie->name : '-' }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('todo.edit', ['task' => $task->id]) }}"
                                    class="text-blue-500 hover:text-blue-700 font-medium mr-4">Edit</a>

                                <form action="{{ route('todo.softdelete', ['task' => $task->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
