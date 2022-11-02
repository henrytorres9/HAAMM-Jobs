<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
  public $titulo;
  public $salario;
  public $categoria;
  public $empresa;
  public $ultimo_dia;
  public $descripcion;
  public $imagen;

  use WithFileUploads;
  
  protected $rules = [
    'titulo' => 'required|string|max:100',
    'salario' => 'required|numeric|between:1,9',
    'categoria' => 'required|numeric|between:1,7',
    'empresa' => 'required|max:100',
    'ultimo_dia' => 'required',
    'descripcion' => 'required',
    'imagen' => 'required|image|max:1024',
  ];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }
  
  public function crearVacante()
  {
    $datos = $this->validate();

    // Almacenando la imagen
    $imagen = $this->imagen->store('public/vacantes');
    $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);

    // dd($nombre_imagen); //Obtiene la ruta del archivo
    // dd($datos['imagen']); //Obtiene la ruta del archivo

    // Creando la vacante
    Vacante::create([
      'titulo' => $datos['titulo'],
      'salario_id' => $datos['salario'],
      'categoria_id' => $datos['categoria'],
      'empresa' => $datos['empresa'],
      'ultimo_dia' => $datos['ultimo_dia'],
      'descripcion' => $datos['descripcion'],
      'imagen' => $datos['imagen'],
      'user_id' => auth()->user()->id,
    ]);

    // Creando el mensaje de vacante publicada
    session()->flash('mensaje', 'La vacante se publicó correctamente.');

    // Redireccionar al usuario a la vista de vacantes disponibles
    return redirect()->route('vacantes.index');
  }

  public function render()
  {
    // Consultar BD
    $salarios = Salario::all();
    $categorias = Categoria::all();

    return view('livewire.crear-vacante', [
      'salarios' => $salarios,
      'categorias' => $categorias
    ]);
  }
}