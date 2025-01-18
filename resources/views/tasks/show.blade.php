<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tarea: {{ $task->description }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div x-data="{ showPopup: false, showEditPopup: false, showDeletePopup: false, name: '{{ $task->name }}', description: '{{ $task->description }}' }" class="bg-white">
                        <div class="flex space-x-4">
                            <form x-ref="markTaskForm" method="POST" action="{{ route('mark-task', ['task_id' => $task->id, 'user_id' => $user->id]) }}">
                                @csrf
                                <button @click.prevent="showPopup = true" type="button" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                    Marcar Tarea 
                                </button>   
                            </form>
                            <div x-show="showPopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                    <h2 class="text-lg font-semibold mb-4">Estás segur@ que deseas marcar como tarea hecha?</h2>
                                    <div class="flex justify-center space-x-8">
                                        <button @click="$refs.markTaskForm.submit()" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                            Zi
                                        </button>
                                        <button @click="showPopup = false" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                            No deseo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <form x-ref="editTaskForm" method="POST" action="{{ route('update-task', ['task_id' => $task->id]) }}" @submit.prevent="validateForm">
                                @csrf
                                @method('PUT')
                                <button @click.prevent="showEditPopup = true" type="button" class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">
                                    Editar Tarea
                                </button>
                            
                                <div x-show="showEditPopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                    <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                        <h2 class="text-lg font-semibold mb-4">Formulario Para Editar Tarea</h2>
                                        <div class="mb-4">
                                            <label for="edit_name" class="block text-gray-700">Nombre de la tarea:</label>
                                            <input type="text" id="name" name="name" x-model="name" class="mt-2 px-4 py-2 border border-gray-300 rounded-md w-full" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="edit_description" class="block text-gray-700">Descripción:</label>
                                            <input type="text" id="description" name="description" x-model="description" class="mt-2 px-4 py-2 border border-gray-300 rounded-md w-full" required>
                                        </div>
                                        <div class="flex justify-center space-x-8">
                                            <button @click.prevent="$refs.editTaskForm.submit()" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                                Guardar
                                            </button>
                                            <button @click="showEditPopup = false" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                           
                        </div>
                    </div>
                    <div class="mt-8 overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Usuario
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Completada el
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Validada por
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Validada el
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Validar
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shifts as $shift)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $shift->user->name }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ date('H:i d-m-y', strtotime($shift->completed_at)) }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $shift->validator->name ?? 'N/A' }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $shift->validated_at ? date('H:i d-m-y', strtotime($shift->validated_at)) : 'N/A' }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" x-data="{ showPopup: false }">
                                            @if (!isset($shift->validator->name))
                                            <div x-data="{ showPopup: false, showErrorPopup: false, userRole: '{{ $user->roles->first()->name }}' }" class="bg-white">
                                                <form x-ref="validateShiftForm" method="POST" action="{{ route('validate-shift', ['task_id' => $task->id, 'user_id' => $user->id, 'shift_id' => $shift->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button @click.prevent="if (userRole.trim() === 'sons') {showErrorPopup = true;} else {showPopup = true;}" 
                                                        class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                                                        Validar
                                                    </button>
                                                </form>
                                                <div x-show="showPopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                                    <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                                        <h2 class="text-lg font-semibold">Estás segur@ que quieres validar esta tarea?</h2>
                                                        <div class="flex justify-center space-x-8">
                                                            <button @click="$refs.validateShiftForm.submit()" class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                                                Zi
                                                            </button>
                                                            <button @click="showPopup = false" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                                                No deseo
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-show="showErrorPopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                                    <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                                        <h2 class="text-lg font-semibold text-red-500">Pasa malcriao tu no puedes validar</h2>
                                                        <button @click="showErrorPopup = false" class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                                            Cerrar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                                <button @click.prevent="showPopup = true" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                                                    Validar
                                                </button>
                                                <div x-show="showPopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                                    <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                                        <h2 class="text-lg font-semibold">Este registro ya fue validado</h2>
                                                        <div class="flex justify-center space-x-8">
                                                            <button @click="showPopup = false" class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                                                Cerrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div x-data="{ showPopup: false, showEditPopup: false, showDeletePopup: false, name: '{{ $task->name }}', description: '{{ $task->description }}' }" class="bg-white">
                        <div class="flex space-x-4">
                            <form x-ref="deleteTaskForm" method="POST" action="{{ route('delete-task', ['task_id' => $task->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button @click.prevent="showDeletePopup = true" type="button" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                    Eliminar Tarea
                                </button>
                              
                            </form>
                            <div x-show="showDeletePopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                    <h2 class="text-lg font-semibold mb-4">Estás seguro que deseas eliminar esta tarea?</h2>
                                    <div class="flex justify-center space-x-8">
                                        <button @click.prevent="$refs.deleteTaskForm.submit()" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                            Sí
                                        </button>
                                        <button @click="showDeletePopup = false" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                            No deseo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>