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
                <br>
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon align-middle">
                                <span class="material-icons text-md">
                                    thumb_up_off_alt
                                </span>
                            </span>
                            <span class="alert-text">{{ session()->get('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-icon align-middle">
                                <span class="material-icons text-md">
                                    thumb_down_off_alt
                                </span>
                            </span>
                            <span class="alert-text">{{ session()->get('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <br>
                    <div class="col-12">
                        @if($updateDempDet)
                        @include('livewire.demplotmaster.form_pohon')
                        @endif
                    </div>
                </div>
                @if(!$updateDempDet)
                <div class="row">
                    <table class="table align-items-center mb-0">
                        <thead class="alert alert-secondary">
                            <tr>
                                <th>
                                    <button wire:click.prevent="cancel" type="button" class="btn bg-gradient-warning"><i class="material-icons">close</i></button>
                                    <!-- <button wire:click="simpanOrupdate" type="button" class="btn bg-gradient-success"><i class="material-icons">save</i></button> -->
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
                            @foreach ($demplotDet as $key=>$demplot)
                            <tr class="bg-light  p-2 text-white">
                                <td class="align-middle">
                                    <button wire:click="editPohon({{$demplot->detail_id}})" type="button" class="btn btn-success btn-link btn-sm" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                    <button wire:click="destroyPohon({{$demplot->detail_id}}, {{$demplot_id_v}})" wire:confirm="Yakin ingin menghapus ?" type="button" class="btn btn-danger btn-link btn-sm" data-original-title="" title="">
                                        <i class="material-icons">close</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </td>
                                <td>
                                    <span class="text-dark text-xs font-weight-bold">{{$demplot->no_pohon}}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-dark text-xs font-weight-bold"> {{$demplot->pohon_usia}}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-dark text-xs font-weight-bold"> {{$demplot->jumlah_pelapah}}</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">{{$demplot->jumlah_tandan}}</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">{{$demplot->bakal_tandan}}</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">{{$demplot->spiral}}</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">{{$demplot->buah_dompet}}</span>
                                </td>
                            </tr>
                            @endforeach
                            @for ($i = 1; $i <= $demplot_pohon_h - $hitung; $i++) <tr class="bg-light  p-2 text-white">
                                <td class="align-middle">
                                    <button wire:click="editPohon('-',{{$i + $hitung}},'{{$no_bukti_v}}',{{$demplot_id_v}})" type="button" class="btn btn-success btn-link btn-sm" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                    <button wire:click="destroyPohon('-', {{$demplot_id_v}})" wire:confirm="Yakin ingin menghapus ?" type="button" class="btn btn-danger btn-link btn-sm" data-original-title="" title="">
                                        <i class="material-icons">close</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </td>
                                <td>
                                    <span class="text-dark text-xs font-weight-bold">{{$no_bukti_v}}/{{$i + $hitung}}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-dark text-xs font-weight-bold"> 0 </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-dark text-xs font-weight-bold"> 0 </span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">0</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">0</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">0</span>
                                </td>
                                <td class="align-middle text-center text-sm ">
                                    <span class="text-dark text-xs font-weight-bold">0</span>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>