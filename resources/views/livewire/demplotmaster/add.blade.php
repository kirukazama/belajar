<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Data</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store">
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label class="form-label">ID Pelanggan</label>
                    <input wire:model="pelanggan_id" type="number" class="form-control border border-2 p-2" readonly>
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input wire:model="pelanggan_name" type="text" class="form-control border border-2 p-2" disabled>
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">ID Kebun</label>
                    <input wire:model="kebun_id" type="number" class="form-control border border-2 p-2" readonly>
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">No bukti</label>
                    <input wire:model="no_bukti" type="text" class="form-control border border-2 p-2" readonly>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Tanggal Bukti</label>
                    <input wire:model="tgl_bukti" type="date" class="form-control border border-2 p-2">
                    @error('tgl_bukti')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Luas Demplot</label>
                    <input wire:model="demplot_luas" type="number" class="form-control border border-2 p-2">
                    @error('demplot_luas')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Jumlah Pohon Demplot</label>
                    <input wire:model="demplot_pohon" type="number" class="form-control border border-2 p-2">
                    @error('demplot_pohon')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Sesi Demplot</label>
                    <select wire:model="demplot_sesi" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Sesi ::</option>
                        <option value="Identifikasi (Awal)">Identifikasi (Awal)</option>
                        <option value="Sesi I">Sesi I</option>
                        <option value="Sesi II">Sesi II</option>
                    </select>
                    @error('demplot_sesi')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Tahapan Demplot</label>
                    <select wire:model="demplot_tahapan" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Tahap ::</option>
                        <option value="I">Tahap I</option>
                        <option value="II">Tahap II</option>
                        <option value="III">Tahap III</option>
                        <option value="IV">Tahap IV</option>
                        <option value="V">Tahap V</option>
                    </select>
                    @error('demplot_tahapan')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Jenis Pupuk Demplot</label>
                    <input wire:model="jenis_pupuk" type="text" class="form-control border border-2 p-2">
                    @error('jenis_pupuk')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>


            </div>
            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
            <button wire:click.prevent="cancel" type="button" class="btn bg-gradient-danger">Batal</button>

        </form>
    </div>
</div>