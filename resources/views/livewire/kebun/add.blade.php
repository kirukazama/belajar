<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Data</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" >
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">ID Pelanggan</label>
                    <input wire:model="pelanggan_id" type="number" class="form-control border border-2 p-2" readonly>
                    @error('pelanggan_id')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Nama Pelanggan</label>
                    <input wire:model="pelanggan_name" type="text" class="form-control border border-2 p-2" disabled>
                    @error('pelanggan_name')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Luas Kebun</label>
                    <input wire:model="kebun_luas" type="number" class="form-control border border-2 p-2">
                    @error('kebun_luas')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Jumlah Pohon</label>
                    <input wire:model="kebun_pohon" type="number" class="form-control border border-2 p-2">
                    @error('kebun_pohon')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Koordinat</label>
                    <input wire:model="koordinat" type="text" class="form-control border border-2 p-2">
                    @error('koordinat')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
            <button wire:click.prevent="cancel" type="button" class="btn bg-gradient-danger">Batal</button>

        </form>
    </div>
</div>