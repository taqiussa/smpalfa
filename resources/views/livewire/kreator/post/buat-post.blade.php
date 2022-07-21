<div>
    <x-slot name="header">
        <h4>Form Buat Post</h4>
    </x-slot>
    <x-card>
        <form wire:submit.prevent="simpan">
            <div class="col-md-6 my-2">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input wire:model.defer="tanggal" type="date" class="form-control">
                @error('tanggal')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 my-2">
                <label for="judul" class="form-label">Judul</label>
                <input wire:model.defer="judul" type="text" class="form-control">
                @error('judul')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div wire:ignore class="col my-2">
                <label for="isi" class="form-label">Isi Postingan</label>
                <input id="isi" type="hidden" name="isi" value="{{ $isi }}">
                <trix-editor wire:ignore input="isi"></trix-editor>
            </div>
            @error('isi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="col-md-6 my-2">
                <label for="foto" class="form-label">Gambar</label>
                <input wire:model="foto" type="file" class="form-control">
                <div wire:loading wire:target="foto">
                    Uploading...
                </div>
                @if ($foto)
                    <div class="col-md-6 my-1">
                        <img src="{{ $foto->temporaryUrl() }}" alt="foto" class="img img-thumbnail">
                    </div>
                @endif
                @error('foto')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-primary" type="submit">Buat <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
            </div>
        </form>
    </x-card>
    @push('scripts')
        <script>
            var trixEditor = document.getElementById('isi')
            addEventListener('trix-blur', function(e) {
                @this.set('isi', trixEditor.getAttribute('value'))
            })
            document.addEventListener('trix-file-accept', function(e) {
                e.preventDefault();
            })
        </script>
    @endpush
</div>
