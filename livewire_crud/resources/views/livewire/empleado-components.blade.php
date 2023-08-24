<div class="container mt-5">
    <h1 class="mb-4">Formulario de Nombre y Correo</h1>
    <form wire:submit.prevent="crearEmpleado">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" wire:model="nombre" placeholder="Ingresa tu nombre">
            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="correo" wire:model="correo" placeholder="Ingresa tu correo electrónico">
            @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>

    <h2 class="mt-5 mb-3">Usuarios Registrados</h2>
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="search" wire:model="criterio" placeholder="Buscar usuario por nombre">
        <button type="button" wire:click="$refresh" class="btn btn-primary">Buscar</button>
    </div>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->correo }}</td>
                <td>
                    <!-- Add actions buttons or content here -->
                    <button wire:click="eliminarEmpleado({{ $empleado->id }})" class="btn btn-danger">Borrar</button>
                    <button wire:click="abrirModal({{ $empleado->id }})" class="btn btn-primary">Detalles</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal para mostrar detalles del usuario -->
    @if ($mostrarModal)
    <div class="modal" tabindex="-1" role="dialog" style="display: block; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Usuario</h5>
                    <button type="button" class="close" wire:click="cerrarModal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>ID: {{ $detallesEmpleado->id }}</p>
                    <p>Nombre: {{ $detallesEmpleado->nombre }}</p>
                    <p>Correo Electrónico: {{ $detallesEmpleado->correo }}</p>
                    <!-- Agrega más campos según tus necesidades -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrarModal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>