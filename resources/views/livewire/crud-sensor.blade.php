<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <div class="flex justify-between mx-2 mb-4">
            <!--Input de busqueda   -->
            {{-- <div class="flex items-center p-2 rounded-md flex-1">
                <label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
                    <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25"  fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <x-jet-input type="text" wire:model="search" class="w-full block pl-14" placeholder="Buscar Noticia..."/>
                </label>
            </div> --}}
            <!--Boton nuevo   -->
            {{-- <div class="lg:ml-40 ml-10 space-x-8">
                    <button wire:click="create()" class="bg-green-700 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer" >
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if($isOpen)
                        @include('livewire.client-create')
                    @endif
            </div> --}}
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Fecha de registro" class="font-bold"/>
                <x-jet-input type="date" wire:model="datereg" class="w-full"/>
            </div>
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Posición" class="font-bold"/>
                <select wire:model="place" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                  <option>Seleccione Opción</option>
                  <option value="1">Invernadero</option>
                  <option value="2">Patio ASPAAH</option>
                </select>
            </div>
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Localización" class="font-bold"/>
                <select wire:model.defer="location" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                  <option>Seleccione Opción</option>
                  <option value="1">Finca ASPAAH</option>
                </select>
            </div>
            <div class="ml-4">
                <x-jet-label value="Descargar" class="font-bold"/>
                <a href="{{ URL::to('/sensores/pdf') }}" target="_blank"><i class="fa-solid fa-file-pdf fa-2x"></i></a>
            </div>
        </div>
        <!--Tabla lista de items   -->
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200 table-auto">
              <thead class="bg-green-700 text-white">
                <tr class="text-left text-xs font-bold  uppercase">
                  <td scope="col" class="px-6 py-3">ID</td>
                  <td scope="col" class="px-6 py-3">Fecha reg.</td>
                  <td scope="col" class="px-6 py-3">Temperatura °C</td>
                  <td scope="col" class="px-6 py-3">Humedad</td>
                  <td scope="col" class="px-6 py-3">Ubicación</td>
                  <td scope="col" class="px-6 py-3">Posición</td>
                  <td scope="col" class="px-6 py-3">Tipo</td>
                  {{-- <td scope="col" class="px-6 py-3">Opciones</td> --}}
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @foreach ($sensors as $item)
                <tr class="text-sm font-medium text-gray-900">
                  <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-700 text-white">
                      {{$item->id}}
                    </span>
                  </td>
                  <td class="px-6 py-4">{{$item->fechatreg}}</td>
                  <td class="px-6 py-4">{{$item->temperatura}}</span></td>
                  <td class="px-6 py-4">{{$item->humedad}}</td>
                  <td class="px-6 py-4">{{$item->location->nombrelugar}}</td>
                  <td class="px-6 py-4">{{$item->place->name}}</td>
                  <td class="px-6 py-4">{{$item->place->type}}</td>
                  {{-- <td class="px-6 py-4 flex gap-1">
                    <x-jet-button wire:click="edit({{$item}})">
                        <i class="fas fa-edit"></i>
                    </x-jet-button>
                    <x-jet-danger-button wire:click="$emit('deleteItem',{{$item->id}})">
                        <i class="fas fa-trash"></i>
                    </x-jet-danger-button>
                  </td> --}}
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        @if(!$sensors->count())
            No existe ningun registro conincidente
        @endif
        @if($sensors->hasPages())
            <div class="px-6 py-3">
            {{$sensors->links()}}
            </div>
        @endif
        </div>
      </div>

      <!--Scripts - Sweetalert   -->
      @push('js')
        <script>
          Livewire.on('deleteItem',id=>{
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    //alert(id);
                    Livewire.emitTo('crud-client','delete',id);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                }
              })
          });
        </script>
      @endpush
</div>
