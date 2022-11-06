<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
  use WithFileUploads;

  public $cv;
  public $vacante;

  protected $rules = [
    'cv' => 'required|mimes:pdf'
  ];

  public function mount(Vacante $vacante)
  {
    // dd($vacante);
    $this->vacante = $vacante;
  }

  public function postularme()
  {
    $datos = $this->validate();

    // Almacenando el CV
    $cv = $this->cv->store('public/cv');
    $datos['cv'] = str_replace('public/cv/', '', $cv);

    // Crear el candidato a la vacante
    $this->vacante->candidatos()->create([
      'user_id' => auth()->user()->id,      
      'cv' => $datos['cv']      
    ]);

    // Crear notificación y enviar el email
    $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));
    
    // Mostrar al usuario un mensaje que se envió correctamente
    session()->flash('mensaje', 'Se ha enviado correctamente tu información. ¡Mucha suerte!');

    return redirect()->back();
  }

  public function render()
  {
    return view('livewire.postular-vacante');
  }
}
