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
                                                <th class="text-uppercase text-white text-xs font-weight-bolder">
                                                    No
                                                </th>
                                                <th class="text-uppercase text-white text-xs font-weight-bolder">
                                                    Nama</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Alamat</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Telpon Pelanggan</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Perusahaan</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Telepon Perusahaan</th>
                                                <th class="text-white"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dPelanggan as $key => $rPelanggan)
                                            <?php $no = 1; ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{$loop->iteration}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
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
                                                <td class="align-middle">
                                                    <button wire:click="create({{$rPelanggan->pelanggan_id}})" type="button" class="btn btn-dark btn-link btn-sm" data-original-title="" title="">
                                                        <i class="material-icons">add</i>
                                                        <div class="ripple-container">&nbsp; Kebun</div>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <table class="table align-items-center mb-0">
                                                        <thead class="alert alert-secondary">
                                                            <tr>
                                                                <th></th>
                                                                <th class="text-uppercase text-light text-xxs font-weight-bolder">
                                                                    No
                                                                </th>
                                                                <th class="text-uppercase text-light text-xxs font-weight-bolder">
                                                                    ID Kebun</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Luas Kebun</th>
                                                                <th class="text-center text-uppercase text-light text-xxs font-weight-bolder">
                                                                    Jumlah Pohon</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($dKebun as $key => $rKebun)
                                                            @if($rPelanggan->pelanggan_id == $rKebun->pelanggan_id)
                                                            <tr class="bg-light  p-2 text-white">
                                                                <td></td>
                                                                <td>
                                                                    <span class="text-dark text-xs font-weight-bold">{{$no++}}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rKebun->kebun_id}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-dark text-xs font-weight-bold"> {{$rKebun->kebun_luas}}</span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm ">
                                                                    <span class="text-dark text-xs font-weight-bold">{{$rKebun->kebun_pohon}}</span>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <button wire:click="edit({{$rKebun->kebun_id}})" type="button" class="btn btn-success btn-link btn-sm" data-original-title="" title="">
                                                                        <i class="material-icons">edit</i>
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                    <button wire:click="destroy({{$rKebun->kebun_id}})" wire:confirm="Yakin ingin menghapus ?" type="button" class="btn btn-danger btn-link btn-sm" data-original-title="" title="">
                                                                        <i class="material-icons">close</i>
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php unset($dKebun[$key]); ?>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
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