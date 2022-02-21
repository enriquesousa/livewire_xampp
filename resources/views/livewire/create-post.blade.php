<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    {{-- boton rojo - Crear Post --}}
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear post
    </x-jet-danger-button>

    {{-- Ventana Modal para Crear Post --}}
    <x-jet-dialog-modal wire:model='open'>

        <x-slot name='title'>
            Crear nuevo post
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Título del Post"></x-jet-label>
                <x-jet-input type="text" class="w-full" wire:model="title"></x-jet-input>
                <x-jet-input-error for='title' />
            </div>
            <div class="mb-4">
                <x-jet-label value="Contenido del Post"></x-jet-label>
                <textarea wire:model.defer="content" class="w-full" rows="6"></textarea>
                <x-jet-input-error for='content' />
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target='save' class="disabled:opacity-25">
                Crear Post
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
