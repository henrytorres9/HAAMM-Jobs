<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
  public $vacante_id;
  public $titulo;
  public $salario;
  public $categoria;
  public $empresa;
  public $ultimo_dia;
  public $descripcion;
  public $imagen;
  public $imagen_nueva;

  use WithFileUploads;

  protected $rules = [
    'titulo' => 'required|string|max:100',
    'salario' => 'required|numeric|between:1,9',
    'categoria' => 'required|numeric|between:1,7',
    'empresa' => 'required|max:100',
    'ultimo_dia' => 'required',
    'descripcion' => 'required',
    'imagen_nueva' => 'nullable|image|max:1024'
  ];
  
  public function mount(Vacante $vacante)
  {
    $this->vacante_id = $vacante->id;
    $this->titulo = $vacante->titulo;
    $this->salario = $vacante->salario_id;
    $this->categoria = $vacante->categoria_id;
    $this->empresa = $vacante->empresa;
    $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
    $this->descripcion = $vacante->descripcion;
    $this->imagen = $vacante->imagen;
  }

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function editarVacante()
  {
    $datos = $this->validate();

    // Validar si hay una nueva imagen
    if($this->imagen_nueva){
      $imagen = $this->imagen_nueva->store('public/vacantes');
      $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
    }

    // Encontrar la vacante a editar
    $vacante = Vacante::find($this->vacante_id);

    // Asignar los valores
    $vacante->titulo = $datos['titulo'];
    $vacante->salario_id = $datos['salario'];
    $vacante->categoria_id = $datos['categoria'];
    $vacante->titulo = $datos['titulo'];
    $vacante->titulo = $datos['titulo'];
    $vacante->empresa = $datos['empresa'];
    $vacante->ultimo_dia = $datos['ultimo_dia'];
    $vacante->descripcion = $datos['descripcion'];
    $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

    // Guarda/actualizar la vacante
    $vacante->save();

    // Creando el mensaje de vacante actualizada
    session()->flash('mensaje', 'La vacante se actualizó correctamente.');

    // Redireccionar al usuario a la vista de vacantes disponibles
    return redirect()->route('vacantes.index');
  }

  public function render()
  {
    // Consultar BD
    $salarios = Salario::all();
    $categorias = Categoria::all();
    
    return view('livewire.editar-vacante', [
      'salarios' => $salarios,
      'categorias' => $categorias
    ]);
  }
}