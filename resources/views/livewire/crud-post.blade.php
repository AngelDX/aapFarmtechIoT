<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <div class="flex items-center justify-between">
            <!--Input de busqueda   -->
            <div class="flex items-center p-2 rounded-md flex-1">
                <label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
                    <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25"  fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <x-jet-input type="text" wire:model="search" class="w-full block pl-14" placeholder="Buscar Noticia..."/>
                </label>
            </div>
            <!--Boton nuevo   -->
            <div class="lg:ml-40 ml-10 space-x-8">
                    <button wire:click="create()" class="bg-green-700 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer" >
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if($isOpen)
                        @include('livewire.post-create')
                    @endif
            </div>
        </div>
        <!--Tabla lista de items   -->
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200 table-auto">
              <thead class="bg-green-700 text-white">
                <tr class="text-left text-xs font-bold  uppercase">
                  <td scope="col" class="px-6 py-3">ID</td>
                  <td scope="col" class="px-6 py-3">Titulo</td>
                  <td scope="col" class="px-6 py-3">Status</td>
                  <td scope="col" class="px-6 py-3">Categoria</td>
                  <td scope="col" class="px-6 py-3">Usuario</td>
                  <td scope="col" class="px-6 py-3">Fecha</td>
                  <td scope="col" class="px-6 py-3">Opciones</td>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @foreach ($posts as $item)
                <tr class="text-sm font-medium text-gray-900">
                  <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-700 text-white">
                      {{$item->id}}
                    </span>
                  </td>
                  <td class="px-6 py-4">{{$item->title}}</td>
                  <td class="px-6 py-4"><span class="{{($item->status==1)?'bg-green-700 rounded-xl text-white p-1':'bg-yellow-600 rounded-xl text-white p-1'}}">{{($item->status=='1'?'Publicado':'Borrador')}}</span></td>
                  <td class="px-6 py-4">{{$item->category->name}}</td>
                  <td class="px-6 py-4">{{$item->user->name}}</td>
                  <td class="px-6 py-4">{{$item->created_at}}</td>
                  <td class="px-6 py-4 flex gap-1">
                    <x-jet-button wire:click="edit({{$item}})">
                        <i class="fas fa-edit"></i>
                    </x-jet-button>
                    {{-- <a href="{{ route('post-edit',$item->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        <i class="fas fa-edit"></i></a> --}}
                    <x-jet-danger-button wire:click="$emit('deleteItem',{{$item->id}})"> <!-- Usamos metodos magicos -->
                        <i class="fas fa-trash"></i>
                    </x-jet-danger-button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        @if(!$posts->count())
            No existe ningun registro conincidente
        @endif
        @if($posts->hasPages())
            <div class="px-6 py-3">
            {{$posts->links()}}
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
                    Livewire.emitTo('crud-post','delete',id);
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
