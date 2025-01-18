<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro General') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div x-data="{ showPopup: false }" class="bg-white">
                        <form x-ref="createTaskForm" method="POST" action="{{ route('create-task') }}" @submit.prevent="validateForm">
                            @csrf
                            <button @click.prevent="showPopup = true" type="button" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                                Crear Nueva Tarea
                            </button>
                        
                            <div x-show="showPopup" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75" x-transition>
                                <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                                    <h2 class="text-lg font-semibold mb-4">Formulario Para Crear Nueva Tarea</h2>
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700">Nombre de la tarea:</label>
                                        <input type="text" id="name" name="name"  class="mt-2 px-4 py-2 border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-700">Descripción:</label>
                                        <input type="text" id="description" name="description"  class="mt-2 px-4 py-2 border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div class="flex justify-center space-x-8">
                                        <button @click.prevent="$refs.createTaskForm.submit()" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                            Guardar
                                        </button>
                                        <button @click="showPopup = false" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <!-- Tabla con estilos -->
                    <div class="mt-8 overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Usuario
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                        Tarea
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shifts as $shift)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $shift->user->name }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $shift->task->name }}
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>