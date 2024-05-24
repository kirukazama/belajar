<div>
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if($createPelanggan)
                @include('livewire.pelanggan.add')
                <br>
                @endif

                @if($updatepelanggan)
                @include('livewire.pelanggan.edit')
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
                @if(!$createPelanggan && !$updatepelanggan)
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div></div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <button wire:click="create" class="btn bg-gradient-dark btn-sm mb-0"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Pelanggan</button>
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
                                    <table class="table table-flush dataTable-table" id="products-list">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    No
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nama</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Alamat</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Telpon Pelanggan</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Perusahaan</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Telepon Perusahaan</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dPelanggan as $rPelanggan)
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
                                                    <button wire:click="edit({{$rPelanggan->pelanggan_id}})" type="button" class="btn btn-success btn-link btn-sm" data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                    <button wire:click="destroy({{$rPelanggan->pelanggan_id}})" wire:confirm="Yakin ingin menghapus ?" type="button" class="btn btn-danger btn-link btn-sm" data-original-title="" title="">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" align="center"> Data pelanggan belum ada </td>
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