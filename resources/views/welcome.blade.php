<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#FAFAFA]">
    <main>
        <div class="flex flex-col mx-[200px] my-[131px] ">
            <div class="w-[1100px] ">
                <div class="flex justify-center">
                    <img src="{{ asset('images/energeek.svg') }}" class="fit-cove" alt="">
                </div>
                <form action="{{ route('todo.store') }}" class="gap-[30px] grid" method="POST">
                    @if ($errors->any())
                        <div class="grid justify-center">
                            <div class="text-center bg-red-500 w-96 rounded-md  text-white">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @csrf
                    <input type="hidden" name="todo_count" id="todo_count" value="0">
                    <div class="flex justify-center">
                        <div class="flex gap-[30px] p-[30px] w-full h-[138px]  bg-white mt-[30px] rounded-xl">
                            <div class="flex flex-col">
                                <label for="nama" class="font-poppins text-base font-normal text-black">Nama</label>
                                <input type="text" id="nama" name="name"
                                    class="mt-[10px] w-[326px] h-[46px] px-4 py-3 font-sans border border-[#E4E6EF] rounded-md text-[#B5B5C3] focus:text-black"
                                    placeholder="Nama" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="username"
                                    class="font-poppins text-base font-normal text-black">Username</label>
                                <input type="text" id="username" name="username"
                                    class="mt-[10px] w-[326px] h-[46px] px-4 py-3 font-sans border border-[#E4E6EF] rounded-md text-[#B5B5C3] focus:text-black"
                                    placeholder="Username" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="email"
                                    class="font-poppins text-base font-normal text-black">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-[10px] w-[326px] h-[46px] px-4 py-3 font-sans border border-[#E4E6EF] rounded-md text-[#B5B5C3] focus:text-black "
                                    placeholder="Email" required>
                            </div>
                        </div>
                    </div>



                    <div class="flex justify-between">
                        <h1 class="font-sans font-medium text-[#3F4254] text-[22px]">To Do List</h1>
                        <button type="button" id="add-todo"
                            class="w-[200px] h-[47px] rounded-xl bg-[#FFE2E5] px-5 py-[10px] gap-4 flex justify-center items-center">
                            <img src="{{ asset('images/plus.svg') }}" class="w-4" alt="">
                            <p class="font-sans font-medium text-[#F1416C] text-lg">Tambah To
                                Do</p>
                        </button>
                    </div>

                    <div id="todo-list">
                    </div>

                    <button type="submit"
                        class="w-full bg-[#049C4F] h-[47px] px-5 py-[10px] text-center rounded-xl font-sans font-medium text-lg text-white mt-32">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </main>

    
    <script>
        const addTodoButton = document.getElementById('add-todo');
        const todoList = document.getElementById('todo-list');
        let todoCount = 0;

        function addSweetAlertToDeleteButton(button) {
            button.addEventListener("click", function() {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "To do yang dihapus tidak dapat  dikembalikan.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#F64E60",
                    cancelButtonColor: "#F3F6F9",
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const todoItem = button.parentElement.parentElement;
                        if (todoItem) {
                            todoItem.remove();
                            todoCount--;
                            document.getElementById('todo_count').value = todoCount;
                        } else {
                            console.error("To Do item not found!");
                        }
                        Swal.fire({
                            title: "Berhasil!",
                            text: "To do berhasil dihapus",
                            icon: "success",
                            confirmButtonColor: "#50CD89",
                            confirmButtonText: "Selesai",
                        });
                    }
                });
            });
        }

        addTodoButton.addEventListener('click', () => {
            todoCount++;
            document.getElementById('todo_count').value = todoCount;

            const newTodoDiv = document.createElement('div');
            newTodoDiv.className = 'flex gap-6';
            newTodoDiv.id = `todo-${todoCount}`;
            newTodoDiv.innerHTML = `
                <div class="grid gap-[10px]">
                    <label for="todo-description-${todoCount}" class="font-sans font-normal text-base text-[#3F4254]">Judul To Do</label>
                    <input type="text" id="todo-description-${todoCount}" name="todos[${todoCount}][description]" 
                        class="w-[875px] h-[46px] px-4 py-3 font-sans border bg-white border-[#E4E6EF] rounded-md text-[#B5B5C3] focus:text-black"
                        placeholder="Judul To Do" required>
                </div>
                <div class="flex gap-6">
                    <div class="grid gap-[10px]">
                        <label for="category-${todoCount}" class="font-sans font-normal text-base text-[#3F4254]">Kategori</label>
                        <div class="relative items-center flex">
                            <select name="todos[${todoCount}][category_id]" required
                                class="w-[135px] h-[46px] px-4 py-3 font-sans border bg-white border-[#E4E6EF] rounded-md text-[#181C32] appearance-none pr-8"
                                id="category-${todoCount}">
                                @foreach ($categories as $category) 
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4 absolute top-6 right-4 transform -translate-y-1/2 pointer-events-none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-end">
                    <button type="button" class="delete-todo w-[41px] h-[41px]  rounded-xl bg-[#F1416C] items-center grid justify-center" data-todo-id="${todoCount}" onclick="deleteTodo(${todoCount})"> 
                        <img src="{{ asset('images/trash.svg') }}" alt="">
                    </button>
                </div>
            `;


            todoList.appendChild(newTodoDiv);

            const newDeleteButton = document.querySelector(`#todo-${todoCount} .delete-todo`);
            addSweetAlertToDeleteButton(newDeleteButton);
        });
    </script>
</body>

</html>
