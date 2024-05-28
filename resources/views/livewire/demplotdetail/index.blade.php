<div>
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if($createDempDet)
                @include('livewire.demplotdetail.add')
                <br>
                @endif

                @if($updateDempDet)
                @include('livewire.demplotdetail.edit')
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
                @if(!$createDempDet && !$updateDempDet)
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
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Nama <br> Alamat <br> Perusahaan</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    No Bukti <br> (Tanggal Bukti)</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Luas Demplot <br> (Jumlah Pohon Demplot)</th>
                                                <th class="text-center text-uppercase text-white text-xs font-weight-bolder">
                                                    Tahapan <br> (Sesi Demplot)</th>
                                                <th class="text-white"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($dDemplotMas as $key => $rDemplotMas)
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
                                                        <h6 class="mb-0 text-sm">{{$rDemplotMas->pelanggan->pelanggan_name}}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{$rDemplotMas->pelanggan->pelanggan_alamat}}, <br> <strong>Kel/Desa. </strong> {{ucwords(strtolower($rDemplotMas->pelanggan->keldes->keldes_name))}}, <br>
                                                            <strong>Kec. </strong>{{ucwords(strtolower($rDemplotMas->pelanggan->keldes->kecamatan->kec_name))}}, <br> <strong>Kab/Kota. </strong>{{ucwords(strtolower($rDemplotMas->pelanggan->keldes->kecamatan->kabkot->kabkot_name))}},
                                                            <br> <strong>Prov. </strong>{{ucwords(strtolower($rDemplotMas->pelanggan->keldes->kecamatan->kabkot->provinsi->provinsi_name))}}
                                                        </p>
                                                        <span class="text-secondary text-xs font-weight-bold">{{$rDemplotMas->pelanggan->perusahaan_name}}</span>

                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{$rDemplotMas->no_bukti}} <br> ({{$rDemplotMas->tgl_bukti}})
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{$rDemplotMas->demplot_luas}} Hektar <br> ({{$rDemplotMas->demplot_pohon}} btg)
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    {{$rDemplotMas->demplot_tahapan}} <br> ({{$rDemplotMas->demplot_sesi}})
                                                </td>
                                                <td class="align-middle">
                                                    <button wire:click="create({{$rDemplotMas->demplot_id}})" type="button" class="btn btn-dark btn-link btn-sm" data-original-title="" title="">
                                                        <i class="material-icons">add</i>
                                                        <div class="ripple-container">&nbsp; detail</div>
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" align="center"> Data Kebun belum ada </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dataTable-bottom">
                                    {{$dDemplotMas->links()}}
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