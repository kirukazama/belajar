<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Data</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input wire:model="pelanggan_name_v" type="text" class="form-control border border-2 p-2" disabled>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">ID Kebun</label>
                        <input wire:model="kebun_id_v" type="number" class="form-control border border-2 p-2" disabled>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">ID Demplot</label>
                        <input wire:model="demplot_id_v" type="number" class="form-control border border-2 p-2" disabled>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">No bukti</label>
                        <input wire:model="no_bukti_v" type="text" class="form-control border border-2 p-2" disabled>
                    </div>
                </div>
                <div class="row">
                    <table class="table align-items-center mb-0">
                        <thead class="alert alert-secondary">
                            <tr>
                                <th>
                                    <button wire:click.prevent="cancel" type="button" class="btn bg-gradient-danger"><i class="material-icons">close</i></button>
                                    <button wire:click="simpanOrupdate" type="button" class="btn bg-gradient-success"><i class="material-icons">save</i></button>
                                </th>
                                <th class="text-uppercase text-white text-xs font-weight-bolder">
                                    No Pohon
                                </th>
                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                    Usia Pohon
                                </th>
                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                    Jumlah Pelapah
                                </th>
                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                    Tandan
                                </th>
                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                    Bakal Tandan
                                </th>
                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                    Spiral
                                </th>
                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                    Buah Dompet
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formData as $key=>$value)
                            @if($key !== 0)
                            <tr>
                                <form>
                                    <input wire:model="formData.{{$key}}.demplot_id" type="hidden" class="form-control border border-2 p-2" readonly>
                                    <input wire:model="formData.{{$key}}.detail_id" type="hidden" class="form-control border border-2 p-2" readonly>
                                    <input wire:model="formData.{{$key}}.no_bukti" type="hidden" class="form-control border border-2 p-2" readonly>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.no_pohon" type="number" class="form-control border border-2 p-2" readonly>
                                        @error('input'.$key.'no_pohon')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.pohon_usia" type="number" class="form-control border border-2 p-2">
                                        @error('input'.$key.'pohon_usia')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.jumlah_pelapah" type="number" class="form-control border border-2 p-2">
                                        @error('input'.$key.'jumlah_pelapah')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.jumlah_tandan" type="number" class="form-control border border-2 p-2">
                                        @error('input'.$key.'jumlah_tandan')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.bakal_tandan" type="number" class="form-control border border-2 p-2">
                                        @error('input'.$key.'bakal_tandan')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.spiral" type="number" class="form-control border border-2 p-2">
                                        @error('input'.$key.'spiral')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input wire:model="formData.{{$key}}.buah_dompet" type="number" class="form-control border border-2 p-2">
                                        @error('input'.$key.'buah_dompet')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </td>
                                </form>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>