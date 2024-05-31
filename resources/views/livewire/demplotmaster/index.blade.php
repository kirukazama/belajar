<div>
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if($createDemplot)
                @include('livewire.demplotmaster.add')
                <br>
                @endif

                @if($updateDemplot)
                @include('livewire.demplotmaster.edit')
                <br>
                @endif

                @if($pohondetail)
                @include('livewire.demplotmaster.demplot_detail')
                <br>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if(session()->has('success') && !$pohondetail)
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

                @if(session()->has('error') && !$pohondetail)
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

            <div class="col-12">
                @if(!$createDemplot && !$updateDemplot && !$pohondetail)
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="mb-3 col-md-3">
                                <div>
                                    <select class="form-select border border-2 p-2" wire:model.live="selectedPelanggan">
                                        <option value="">Pilih Klien</option>
                                        @foreach($dCmbKlien as $cmbKlien)
                                        <option value="{{$cmbKlien->pelanggan_id}}">{{$cmbKlien->pelanggan_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-top">

                                </div>
                                <div class="dataTable-container">
                                    <table class="table table-flush dataTable-table">
                                        <thead class="alert alert-success">
                                            <tr>
                                                <th class="text-white text-center text-sm">#</th>
                                                <th class="text-uppercase text-white text-xs font-weight-bolder">
                                                    No
                                                </th>
                                                <th class="text-uppercase text-white text-xs font-weight-bolder">
                                                    Nama Pemilik
                                                </th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Alamat Kebun</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Luas Kebun</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Jumlah Pohon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dKebun as $key => $rKebun)
                                            <?php $no = 1; ?>
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <button wire:click="create({{$rKebun->kebun_id}}, {{$rKebun->pelanggan_id}})" type="button" class="btn btn-dark btn-link" data-original-title="" title="">
                                                        <i class="material-icons">add</i>
                                                        <!-- <div class="ripple-container">&nbsp; Proses</div> -->
                                                    </button>
                                                    @if($rKebun->kebun_id != $id_tampil || $visible)
                                                    <button wire:click.prevent="demplotShow({{$rKebun->kebun_id}})" type="button" class="btn btn-info btn-link" data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                        <!-- <div class="ripple-container">&nbsp; Kebun</div> -->
                                                    </button>
                                                    @else
                                                    <button wire:click.prevent="demplotClose()" type="button" class="btn btn-warning btn-link" data-original-title="" title="">
                                                        <i class="material-icons">visibility_off</i>
                                                        <!-- <div class="ripple-container">&nbsp; Kebun</div> -->
                                                    </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{$loop->iteration}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        <strong> {{$rKebun->pelanggan->pelanggan_name}} </strong>
                                                    </p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{$rKebun->kebun_alamat}}, <br> <strong>Kel/Desa. </strong> {{ucwords(strtolower($rKebun->keldes->keldes_name))}}, <br>
                                                        <strong>Kec. </strong>{{ucwords(strtolower($rKebun->keldes->kecamatan->kec_name))}}, <br> <strong>Kab/Kota. </strong>{{ucwords(strtolower($rKebun->keldes->kecamatan->kabkot->kabkot_name))}},
                                                        <br> <strong>Prov. </strong>{{ucwords(strtolower($rKebun->keldes->kecamatan->kabkot->provinsi->provinsi_name))}}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{$rKebun->kebun_luas}} Hektar</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{$rKebun->kebun_pohon}} btg</span>
                                                </td>
                                            </tr>
                                            @if($showDemplot && $rKebun->kebun_id == $id_tampil)
                                            <tr>
                                                <td colspan="6">
                                                    <table class="table align-items-center mb-0">
                                                        <thead class="alert alert-secondary">
                                                            <tr>
                                                                <th></th>
                                                                <th class="align-middle text-center text-sm">#</th>
                                                                <th class="text-uppercase text-light text-xxs font-weight-bolder">
                                                                    No
                                                                </th>
                                                                <th class="text-uppercase text-light text-xxs font-weight-bolder">
                                                                    No Bukti</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Tanggal Bukti</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Luas Demplot</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Jumlah Pohon Demplot</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Tahapan Demplot</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Sesi Demplot</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($dDemplot as $key => $rDemplot)
                                                            <tr class="bg-light  p-2 text-white">
                                                                <td></td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <button wire:click="edit({{$rDemplot->demplot_id}})" type="button" class="btn btn-success btn-link" data-original-title="" title="">
                                                                        <i class="material-icons">edit</i>
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                    <button wire:click="destroy({{$rDemplot->demplot_id}})" wire:confirm="Yakin ingin menghapus ?" type="button" class="btn btn-danger btn-link" data-original-title="" title="">
                                                                        <i class="material-icons">delete</i>
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                    <button wire:click="detailPohon({{$rDemplot->demplot_id}})" type="button" class="btn btn-info btn-link" data-original-title="" title="">
                                                                        <i class="material-icons">park</i>
                                                                    </button>
                                                                </td>
                                                                <td class="text-center text-sm">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$no++}}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rDemplot->no_bukti}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-dark text-xs font-weight-bold"> {{$rDemplot->tgl_bukti}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm ">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rDemplot->demplot_luas}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm ">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rDemplot->demplot_pohon}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm ">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rDemplot->demplot_tahapan}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm ">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rDemplot->demplot_sesi}}</span>
                                                                </td>
                                                            </tr>
                                                            <?php unset($dDemplot[$key]); ?>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endif
                                            @empty
                                            <tr>
                                                <td colspan="7" align="center"> Data Kebun belum ada </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dataTable-bottom">
                                    {{$dKebun->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function(e) {
            var data = $('#select2').select2("val");

        });
    });
</script>

@endpush