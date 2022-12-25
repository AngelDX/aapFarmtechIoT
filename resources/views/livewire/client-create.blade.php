<div>
    <x-jet-dialog-modal wire:model="isOpen">
      <x-slot name="title">
        <h3>Registro nuevo cliente</h3>
      </x-slot>
      <x-slot name="content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">@csrf
        <div class="flex justify-between mx-2 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Nombres" class="font-bold"/>
            <x-jet-input type="text" wire:model="client.firstname" class="w-full"/>
            <x-jet-input-error for="client.firstname"/>
          </div>
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Apellidos" class="font-bold"/>
            <x-jet-input type="text" wire:model="client.lastname" class="w-full"/>
            <x-jet-input-error for="client.lastname"/>
          </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Correo electrónico" class="font-bold"/>
            <x-jet-input type="text" wire:model.defer="client.email" class="w-full"/>
            <x-jet-input-error for="client.email"/>
          </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Documento" class="font-bold"/>
                <x-jet-input type="text" wire:model.defer="client.document" class="w-full"/>
                <x-jet-input-error for="client.document"/>
            </div>
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Celular" class="font-bold"/>
                <x-jet-input type="text" wire:model.defer="client.cellphone" class="w-full"/>
                <x-jet-input-error for="client.cellphone"/>
            </div>
        </div>
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
              <x-jet-label value="Dirección" class="font-bold"/>
              <x-jet-input type="text" wire:model.defer="client.address" class="w-full"/>
              <x-jet-input-error for="client.address"/>
            </div>
        </div>
        <div class="flex mx-2 mb-6">
            <x-jet-checkbox wire:model.defer="client.privacy" value="1"/>
            <span class="ml-2 text-sm text-gray-600"> Acepto el tratamiento de datos personales</span><br>
            <x-jet-input-error for="client.privacy"/>
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
