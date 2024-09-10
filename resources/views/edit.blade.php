<!DOCTYPE html>
<html>

<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Task</h1>

        <form action="{{ route('todo.update', ['user' => $user->id, 'task' => $task->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="task_id" value="{{ $task->id }}">

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                <textarea name="description" id="description" class="form-input rounded-md shadow-sm w-full" rows="3">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category:</label>
                <select name="category_id" id="category_id" class="form-select rounded-md shadow-sm w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id', $task->category_id)) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <form action="{{ route('todo.update',$task->id) }}">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                        Update Task
                    </button>
                </form>

                <a href="{{ route('todo.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>

</html>
