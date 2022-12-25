<div>
    <x-jet-dialog-modal wire:model="isOpen">
      <x-slot name="title">
        <h3>Registro de noticias</h3>
      </x-slot>
      <x-slot name="content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">@csrf
        <div class="flex justify-between mx-2 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Titulo noticia" class="font-bold"/>
            <x-jet-input type="text" wire:model="post.title" class="w-full"/>
            <x-jet-input-error for="post.title"/>
          </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Slug del noticia" class="font-bold"/>
            <x-jet-input type="text" wire:model.defer="post.slug" class="w-full"/>
            <x-jet-input-error for="post.slug"/>
          </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Cuerpo de la Noticia" class="font-bold"/>
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <textarea wire:model.defer="post.body" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"></textarea>
                    <x-jet-input-error for="post.body"/>
                </div>
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="flex justify-center w-1/2">
                @if($file)  {{--Caso de editar o seleccionar imagen, ya se encuentra un archivo--}}
                    @if(!isset($post['id'])) {{--Si no es un editar, coloca la img temporal seleccionada--}}
                        <img src="{{$file->temporaryUrl()}}">
                    @else
                        @if(substr($file,-3)!='tmp') {{--Si no es archivo temporal--}}
                            <img src="{{$file}}" width="300px">
                        @else
                            <img src="{{$file->temporaryUrl()}}">
                        @endif
                    @endif
                @else
                    <img src="assets/img/defaultnews.jpg">
                @endif
            </div>
            <div class="ml-2">
                <label class="block text-sm text-gray-700 font-bold">Subir foto</label>
                <input type="file" wire:model="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">jpg (max. 800x400px).</p>
                <div wire:loading wire:target="file" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p class="font-bold">!Imagen cargando!</p>
                    <p class="text-sm">Espere hasta que la imagen termine de procesar</p>
                </div>
                <x-jet-input-error for="file"/>
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
              <x-jet-label value="Categoria" class="font-bold"/>
              <select wire:model.defer="post.category_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                <option>Seleccione Opción</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
              <x-jet-input-error for="post.category_id"/>
            </div>
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Status" class="font-bold"/>
                <select wire:model.defer="post.status" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                  <option>Seleccione Opción</option>
                  <option value="1">Publicado</option>
                  <option value="0">No publicado</option>
                </select>
                <x-jet-input-error for="post.status"/>
            </div>
        </div>
        </form>
      </x-slot>
      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-jet-secondary-button>
        <x-jet-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save,file" class="disabled:opacity-50">
          Registrar
        </x-jet-button>
      </x-slot>
    </x-jet-dialog-modal>
</div>
