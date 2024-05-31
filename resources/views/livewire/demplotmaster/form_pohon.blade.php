<div class="card">
    <div class="card-header">
        <h5 class="card-title">Form Demplot</h5>
    </div>
    <div class="card-body">
        <form @if(!$detail_id) wire:submit.prevent="storePohon" @else wire:submit.prevent="updatePohon" @endif>
            <div class="row">
                <input wire:model="kebun_id" type="hidden" class="form-control border border-2 p-2" readonly>
                <input wire:model="demplot_id" type="hidden" class="form-control border border-2 p-2" readonly>
                <input wire:model="no_bukti" type="hidden" class="form-control border border-2 p-2" readonly>

                <div class="mb-3 col-md-3">
                    <label class="form-label">No Pohon</label>
                    <input wire:model="no_pohon" type="number" class="form-control border border-2 p-2" readonly>
                    @error('no_pohon')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Usia Pohon</label>
                    <input wire:model="pohon_usia" type="number" class="form-control border border-2 p-2">
                    @error('pohon_usia')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Jumlah Pelapah</label>
                    <input wire:model="jumlah_pelapah" type="number" class="form-control border border-2 p-2">
                    @error('jumlah_pelapah')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Jumlah Tandan</label>
                    <input wire:model="jumlah_tandan" type="number" class="form-control border border-2 p-2">
                    @error('jumlah_tandan')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Bakal Tandan</label>
                    <input wire:model="bakal_tandan" type="number" class="form-control border border-2 p-2">
                    @error('bakal_tandan')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Spiral</label>
                    <input wire:model="spiral" type="number" class="form-control border border-2 p-2">
                    @error('spiral')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Buah Dompet</label>
                    <input wire:model="buah_dompet" type="number" class="form-control border border-2 p-2">
                    @error('buah_dompet')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
            <button wire:click.prevent="cancelPohonF" type="button" class="btn bg-gradient-danger">Batal</button>

        </form>
    </div>
</div>