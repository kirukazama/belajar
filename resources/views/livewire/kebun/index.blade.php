<div>
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if($createKebun)
                @include('livewire.kebun.add')
                <br>
                @endif

                @if($updateKebun)
                @include('livewire.kebun.edit')
                <br>
                @endif
            </div>
        </div>
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

            <div class="col-12">
                @if(!$createKebun && !$updateKebun)
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div></div>
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
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    No
                                                </th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Nama</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Alamat</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Telpon Pelanggan</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Perusahaan</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Telepon Perusahaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dPelanggan as $key => $rPelanggan)
                                            <?php $no = 1; ?>
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <button wire:click="create({{$rPelanggan->pelanggan_id}})" type="button" class="btn btn-dark btn-link" data-original-title="" title="">
                                                        <i class="material-icons">add</i>
                                                        <!-- <div class="ripple-container">&nbsp; Kebun</div> -->
                                                    </button>
                                                    @if($rPelanggan->pelanggan_id != $id_tampil || $visible)
                                                    <button wire:click.prevent="kebunShow({{$rPelanggan->pelanggan_id}})" type="button" class="btn btn-info btn-link" data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                        <!-- <div class="ripple-container">&nbsp; Kebun</div> -->
                                                    </button>
                                                    @else
                                                    <button wire:click.prevent="kebunClose()" type="button" class="btn btn-warning btn-link" data-original-title="" title="">
                                                        <i class="material-icons">visibility_off</i>
                                                        <!-- <div class="ripple-container">&nbsp; Kebun</div> -->
                                                    </button>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{$loop->iteration}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$rPelanggan->pelanggan_name}}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{$rPelanggan->pelanggan_alamat}}, <br> <strong>Kel/Desa. </strong> {{ucwords(strtolower($rPelanggan->keldes->keldes_name))}}, <br>
                                                        <strong>Kec. </strong>{{ucwords(strtolower($rPelanggan->keldes->kecamatan->kec_name))}}, <br> <strong>Kab/Kota. </strong>{{ucwords(strtolower($rPelanggan->keldes->kecamatan->kabkot->kabkot_name))}},
                                                        <br> <strong>Prov. </strong>{{ucwords(strtolower($rPelanggan->keldes->kecamatan->kabkot->provinsi->provinsi_name))}}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold"> {{$rPelanggan->no_telp}}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{$rPelanggan->perusahaan_name}}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{$rPelanggan->perusahaan_telp}}</span>
                                                </td>
                                            </tr>
                                            @if($showKebun && $rPelanggan->pelanggan_id == $id_tampil)
                                            <tr>
                                                <td colspan="7">
                                                    <table class="table align-items-center mb-0">
                                                        <thead class="alert alert-secondary">
                                                            <tr>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder"> # </th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    No
                                                                </th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Alamat Kebun</th>
                                                                <th class="text-center text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Luas Kebun</th>
                                                                <th class="text-center text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Jumlah Pohon</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($dKebun as $key => $rKebun)
                                                            <tr class="bg-light  p-2 text-white">
                                                                <td class="align-middle text-center text-sm">
                                                                    <button wire:click="edit({{$rKebun->kebun_id}})" type="button" class="btn btn-success btn-link" data-original-title="" title="">
                                                                        <i class="material-icons">edit</i>
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                    <button wire:click="destroy({{$rKebun->kebun_id}}, {{$rKebun->pelanggan_id}})" wire:confirm="Yakin ingin menghapus ?" type="button" class="btn btn-danger btn-link" data-original-title="" title="">
                                                                        <i class="material-icons">close</i>
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$no++}}</span>
                                                                </td>
                                                                <td class="align-middle text-sm">
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{$rKebun->pelanggan_alamat}}, <br> <strong>Kel/Desa. </strong> {{ucwords(strtolower($rKebun->keldes->keldes_name))}}, <br>
                                                                        <strong>Kec. </strong>{{ucwords(strtolower($rKebun->keldes->kecamatan->kec_name))}}, <br> <strong>Kab/Kota. </strong>{{ucwords(strtolower($rKebun->keldes->kecamatan->kabkot->kabkot_name))}},
                                                                        <br> <strong>Prov. </strong>{{ucwords(strtolower($rKebun->keldes->kecamatan->kabkot->provinsi->provinsi_name))}}
                                                                    </p>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-dark text-xs font-weight-bold"> {{$rKebun->kebun_luas}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm ">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rKebun->kebun_pohon}}</span>
                                                                </td>
                                                            </tr>
                                                            <?php unset($dKebun[$key]); ?>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endif
                                            @empty
                                            <tr>
                                                <td colspan="7" align="center"> Data Pelanggan belum ada </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dataTable-bottom">
                                    {{$dPelanggan->links()}}
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