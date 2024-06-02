<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Data</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" >
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label class="form-label">ID Pelanggan</label>
                    <input wire:model="pelanggan_id" type="number" class="form-control border border-2 p-2" readonly>
                    @error('pelanggan_id')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input wire:model="pelanggan_name" type="text" class="form-control border border-2 p-2" disabled>
                    @error('pelanggan_name')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Luas Kebun</label>
                    <input wire:model="kebun_luas" type="number" class="form-control border border-2 p-2">
                    @error('kebun_luas')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Jumlah Pohon</label>
                    <input wire:model="kebun_pohon" type="number" class="form-control border border-2 p-2">
                    @error('kebun_pohon')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Provinsi</label>
                    <select wire:model.live="selectedprovinsi" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Provinsi ::</option>
                        @foreach ($cmbProv as $prov)
                        <option value="{{$prov->provinsi_id}}">{{ ucwords(strtolower($prov->provinsi_name)) }}</option>
                        @endforeach
                    </select>
                </div>

                @if(!is_null($selectedprovinsi))
                <div class="mb-3 col-md-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select wire:model.live="selectedkabkot" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Kabupaten/Kota ::</option>
                        @foreach ($cmbkabkot as $kabkot)
                        <option value="{{$kabkot->kabkot_id}}">{{ ucwords(strtolower($kabkot->kabkot_name)) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if(!is_null($selectedkabkot))
                <div class="mb-3 col-md-3">
                    <label class="form-label">Kecamatan</label>
                    <select wire:model.live="selectedkec" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Kecamatan ::</option>
                        @foreach ($cmbKec as $kec)
                        <option value="{{$kec->kec_id}}">{{ ucwords(strtolower($kec->kec_name)) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if(!is_null($selectedkec))
                <div class="mb-3 col-md-3">
                    <label class="form-label">Kelurahan / Desa</label>
                    <select wire:model.live="keldes_id" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Kelurahan/Desa ::</option>
                        @foreach ($cmbKelDes as $keldes)
                        <option value="{{$keldes->keldes_id}}">{{ ucwords(strtolower($keldes->keldes_name)) }}</option>
                        @endforeach
                    </select>
                    @error('keldes_id')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>
                @endif

                <div class="mb-3 col-md-6">
                    <label class="form-label">Alamat Kebun</label>
                    <input wire:model="kebun_alamat" type="text" class="form-control border border-2 p-2" placeholder="Tidak perlu memasukkan nama kelurahan/desa, Kecamatan, Kabupaten/Kota, dan Provinsi">
                    @error('kebun_alamat')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Koordinat</label>
                    <input wire:model="koordinat" type="text" class="form-control border border-2 p-2">
                    @error('koordinat')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Jenis Tanah</label>
                    <select wire:model.live="tanah_jenis" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Jenis ::</option>
                        <option value="Gambut">Gambut</option>
                        <option value="Berbatu/Berpasir">Berbatu/Berpasir</option>
                        <option value="Rawa">Rawa</option>
                    </select>
                    @error('tanah_jenis')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Kontur tanah</label>
                    <select wire:model.live="tanah_kontur" class="form-select border border-2 p-2">
                        <option value="">:: Pilih Kontur ::</option>
                        <option value="Rata">Rata</option>
                        <option value="Lereng">Lereng</option>
                        <option value="Ketinggian">Ketinggian</option>
                        <option value="Kerendahan">Kerendahan</option>
                    </select>
                    @error('tanah_kontur')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
            <button wire:click.prevent="cancel" type="button" class="btn bg-gradient-danger">Batal</button>

        </form>
    </div>
</div>