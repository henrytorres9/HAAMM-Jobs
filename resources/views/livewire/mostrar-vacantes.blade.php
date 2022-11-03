<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  @forelse ($vacantes as $vacante)
    <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
      <div class="space-y-3">
        <a href="" class="text-xl font-bold">{{ $vacante->titulo }}</a>
        <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
        <p class="text-sm text-gray-500">Último día para postularse: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
      </div>
      <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
        <a href="" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Candidatos</a>
        <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
        <a href="" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Eliminar</a>
      </div>
    </div>
    @empty
    {{-- <p class="p-3 text-center text-sm text-gray-600">No has creado una vacante. </p> --}}
    <p class="p-3 text-center text-sm text-gray-600">No has creado una vacante. Crea una nueva haciendo <a href="{{ route('vacantes.create') }}">Clic aquí</a></p>
  @endforelse
</div>
<div class="mt-10">
  {{ $vacantes->links() }}
</div>