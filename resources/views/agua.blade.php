<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Colocar el Agua') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">     
                    <!-- Botón con estilo -->
                    <form method="POST" action="{{ route('mark-task') }}">
                        @csrf
                        <input type="hidden" name="task_id" value="3"> <!-- Cambiar el valor según sea necesario -->
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                            Marcar como Tarea realizada
                        </button>
                    </form>
                    
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
                                        Validar
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí irán las filas de datos -->
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        Juan Pérez
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        Comprar Refresco
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        2024-07-16
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        María López
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <button class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                                            Validar
                                        </button>
                                    </td>
                                </tr>
                                <!-- Agrega más filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
