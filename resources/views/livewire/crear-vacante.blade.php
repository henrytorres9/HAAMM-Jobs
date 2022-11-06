<form class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'>
  <!-- Título vacante -->
  <div>
    <x-input-label for="titulo" :value="__('Título de la vacante')" />
    <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Escriba el título de la vacante"/>
    @error('titulo')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Salario Mensual -->
  <div>
    <x-input-label for="salario" :value="__('Salario mensual')" />
    <select wire:model="salario" id="salario" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
      <option>-- Seleccione el salario --</option>
      @foreach ($salarios as $salario)
        <option value="{{ $salario -> id }}">{{ $salario -> salario }}</option>        
      @endforeach
    </select>
    @error('salario')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Categoría -->
  <div>
    <x-input-label for="categoria" :value="__('Categoría')" />
    <select wire:model="categoria" id="categoria" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
      <option>-- Seleccione la categoría --</option>
      @foreach ($categorias as $categoria)
        <option value="{{ $categoria -> id }}">{{ $categoria -> categoria }}</option>        
      @endforeach
    </select>
    @error('categoria')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Nombre de la empresa -->
  <div>
    <x-input-label for="empresa" :value="__('Nombre de la empresa')" />
    <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Escriba el nombre de la empresa. Ej. Netflix, Uber, Google." />
    @error('empresa')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Fecha último día de postulación -->
  <div>
    <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
    <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />
    @error('ultimo_dia')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Descripción del puesto -->
  <div>
    <x-input-label for="descripcion" :value="__('Descripción del puesto')" />
    <textarea id="descripcion" wire:model="descripcion" :value="old('descripcion')" placeholder="Escriba la descripción general del puesto, experiencias requeridas, etc." class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full h-72" ></textarea>
    @error('descripcion')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Imagen -->
  <div>
    <x-input-label for="imagen" :value="__('Imagen')" />
    <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*" />

    <div class="my-5 w-80">
      @if ($imagen)
        Vista previa de la imagen:
        <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen con datos de la vacante.">
      @endif
    </div>

    @error('imagen')
      <livewire:mostrar-alerta :message="$message" />
    @enderror
  </div>

  <!-- Botón crear vacante -->
  <x-primary-button class="my-5">
    {{ __('Crear vacante') }}
  </x-primary-button>
</form>