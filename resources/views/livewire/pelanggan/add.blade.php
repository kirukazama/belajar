<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Data</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" >
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Nama Pelanggan</label>
                    <input wire:model="pelanggan_name" type="text" class="form-control border border-2 p-2">
                    @error('pelanggan_name')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label">Nomor Telepon</label>
                    <input wire:model="no_telp" type="text" class="form-control border border-2 p-2">
                    @error('no_telp')
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
                    @error('keldes_id')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
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
                    @error('keldes_id')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
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
                    @error('keldes_id')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
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

                <div class="mb-3 col-md-12">
                    <label class="form-label">Alamat Pelanggan</label>
                    <input wire:model="pelanggan_alamat" type="text" class="form-control border border-2 p-2" placeholder="Tidak perlu memasukkan nama kelurahan/desa, Kecamatan, Kabupaten/Kota, dan Provinsi">
                    @error('pelanggan_alamat')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Nama Perusahaan</label>
                    <input wire:model="perusahaan_name" type="text" class="form-control border border-2 p-2">
                    @error('perusahaan_name')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Nama Pimpinan</label>
                    <input wire:model="pimpinan_name" type="text" class="form-control border border-2 p-2">
                    @error('pimpinan_name')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Telp Perusahaan</label>
                    <input wire:model="perusahaan_telp" type="text" class="form-control border border-2 p-2">
                    @error('perusahaan_telp')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
            <button wire:click.prevent="cancel" type="button" class="btn bg-gradient-danger">Batal</button>

        </form>
    </div>
</div>