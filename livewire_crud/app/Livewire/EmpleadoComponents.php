<?php

namespace App\Livewire;

use App\Models\Empleados;
use Livewire\Component;

class EmpleadoComponents extends Component
{
    public $criterio;
    public $nombre;
    public $correo;
    public $usarioIdObtenido;
    public $detallesEmpleado;
    public $mostrarModal = false;

    public function render()
    {
        $empleados = Empleados::query();

        if (!empty($this->criterio)) {
            $empleados->where('nombre', 'like', "%$this->criterio%");
        }

        $empleados = $empleados->get();

        return view('livewire.empleado-components', compact("empleados"));
    }

    public function crearEmpleado()
    {
        // Validate the input fields
        $this->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email',
        ]);

        // Create a new Empleado
        Empleados::create([
            'nombre' => $this->nombre,
            'correo' => $this->correo,
        ]);

        // Clear the input fields
        $this->nombre = '';
        $this->correo = '';

        // Optionally, you can display a success message or redirect to a different page.
    }

    public function eliminarEmpleado($id)
    {
        // Encuentra el empleado por su ID y elimínalo
        Empleados::find($id)->delete();

        // Vuelve a cargar la lista de empleados después de eliminar uno
        $this->render();
    }

    public function abrirModal($empleadoId)
    {
        $this->usarioIdObtenido = $empleadoId;
        $this->detallesEmpleado = Empleados::find($empleadoId);
        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
    }
}
