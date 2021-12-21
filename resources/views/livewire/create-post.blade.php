<div class="ml-4">
    <x-jet-danger-button wire:click="$set('open', true)">
        Nuevo Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name='title'>
            Nuevo Post
        </x-slot>
        <x-slot name='content'>
            <div wire:loading wire:target='image'
                class="mb-4 bg-red-300 border border-red-700 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Cargando imagen..</strong>
                <span class="block sm:inline">Espere..</span>
            </div>
            @if ($image)
            <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
            @endif
            <div class="mb-4">
                <x-jet-label value='Título' />
                <x-jet-input type='text' class="w-full" wire:model="title" />
                {{-- @error('title')
                <span>
                    {{ $message }}
                </span>
                @enderror --}}
                <x-jet-input-error for='title' />
            </div>
            <div class="mb-4">
                <x-jet-label value='Contenido' />
                <div wire:ignore>
                    <textarea id="editor" class="form-control w-full" rows="6" wire:model="content"></textarea>
                </div>
                {{-- @error('content')
                <span>
                    {{ $message }}
                </span>
                @enderror --}}
                <x-jet-input-error for='content' />
            </div>
            <div>
                <input type="file" wire:model='image' id="{{ $identificador }}">
                <x-jet-input-error for='image' />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr='disabled' wire:target='save, image'
                class="disabled:opacity-25">
                Crear
            </x-jet-danger-button>
            {{-- <span wire:loading wire:target='save'>Cargando..</span> --}}
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
                .create(document.querySelector('#editor'))
                .then(function(editor) {
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    })

                    Livewire.on('resetCKEditor', () => {
                        editor.setData('');
                    })
                })
                .catch(error => {
                    console.error(error);
                });
    </script>

    @endpush
</div>