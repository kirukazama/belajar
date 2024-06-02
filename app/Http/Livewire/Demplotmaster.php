<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kebun as mKebun;
use App\Models\Demplotmaster as mDemplotMas;
use App\Models\Demplotdetail as mDemplotDet;
use App\Models\Pelanggan as mPelanggan;

class Demplotmaster extends Component
{

    public $demplot_id, $no_bukti, $tgl_bukti, $pelanggan_id, $pelanggan_name, $kebun_id, $demplot_luas, $demplot_pohon, $demplot_tahapan, $demplot_sesi, $jenis_pupuk;
    public $updateDemplot = false, $createDemplot = false, $createDempDet, $updateDempDet = false;
    public $formData, $pelanggan_name_v, $kebun_id_v, $demplot_id_v, $no_bukti_v;
    public $detail_id, $no_pohon, $pohon_usia, $jumlah_pelapah, $jumlah_tandan, $bakal_tandan, $spiral, $buah_dompet;
    public $visible = true;
    public $showDemplot, $unVisible, $pohondetail = false;
    public $dDemplot = [];
    public $id_tampil, $pelanggan_id_f;
    public $selectedPelanggan = null;
    public $demplotDet, $hitung, $demplot_pohon_h;

    public function render()
    {
        // $dKebun = mKebun::paginate(5);
        $dCmbKlien = mPelanggan::select('pelanggan_id', 'pelanggan_name')->orderBy('pelanggan_name', 'asc')->get();

        $dKebun = mKebun::when($this->selectedPelanggan, function ($query) {
            $query->where('pelanggan_id', $this->selectedPelanggan);
        })->paginate(5);

        //$dDemplot = mDemplotMas::orderBy('tgl_bukti', 'asc')->get();
        return view('livewire.demplotmaster.index')->with(compact('dKebun'))->with(compact('dCmbKlien')); //->with(compact('dDemplot'))
    }

    public function create($kebun_id, $pelanggan_id)
    {
        $dPelanggan = mPelanggan::where('pelanggan_id', $pelanggan_id)->first();
        $this->resetFields();
        $this->createDemplot = true;
        $this->updateDemplot = false;
        $this->pelanggan_id = $pelanggan_id;
        $this->kebun_id = $kebun_id;
        $this->pelanggan_name = $dPelanggan->pelanggan_name;
        $this->no_bukti = 'DMP-' . $this->pelanggan_id . '-' . $this->kebun_id . '-' . $this->unique_code(5);
    }

    public function resetFields()
    {
        $this->pelanggan_id = '';
        $this->pelanggan_name = '';
        $this->no_bukti = '';
        $this->tgl_bukti = '';
        $this->kebun_id = '';
        $this->demplot_luas = '';
        $this->demplot_pohon = '';
        $this->demplot_tahapan = '';
        $this->demplot_sesi = '';
        $this->jenis_pupuk = '';
    }

    public function cancel()
    {
        $this->dDemplot = mDemplotMas::where('kebun_id', $this->kebun_id)->get();
        $this->resetFields();
        $this->createDemplot = false;
        $this->updateDemplot = false;
        $this->createDempDet = false;
        $this->unVisible = true;
        $this->visible = false;
        $this->pohondetail = false;
        $this->resetFieldsPohon();
    }

    function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function store()
    {
        //$this->validate();

        try {
            mDemplotMas::create([
                'no_bukti' => $this->no_bukti,
                'tgl_bukti' => $this->tgl_bukti,
                'pelanggan_id' => $this->pelanggan_id,
                'kebun_id' => $this->kebun_id,
                'demplot_luas' => $this->demplot_luas,
                'demplot_pohon' => $this->demplot_pohon,
                'demplot_tahapan' => $this->demplot_tahapan,
                'demplot_sesi' => $this->demplot_sesi,
                'jenis_pupuk' => $this->jenis_pupuk,
            ]);

            session()->flash('success', 'Berhasil Menambahkan Data');
            $this->resetFields();
            $this->createDemplot = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data' . $ex);
        }
    }

    public function destroy($id)
    {
        try {
            mDemplotMas::findOrfail($id)->delete();
            $this->dDemplot = mDemplotMas::where('kebun_id', $this->kebun_id)->get();
            session()->flash('success', 'Berhasil Menghapus Data');
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menghapus Data');
        }
    }

    public function edit($id)
    {
        try {
            $demplot =  mDemplotMas::findOrfail($id);
            if (!$demplot) {
                session()->flash('error', 'Data Tidak Ditemukan');
            } else {
                $this->demplot_id = $demplot->demplot_id;
                $this->no_bukti = $demplot->no_bukti;
                $this->tgl_bukti = $demplot->tgl_bukti;
                $this->pelanggan_id = $demplot->pelanggan_id;
                $this->kebun_id = $demplot->kebun_id;
                $this->pelanggan_name = $demplot->pelanggan->pelanggan_name;
                $this->demplot_luas = $demplot->demplot_luas;
                $this->demplot_pohon = $demplot->demplot_pohon;
                $this->demplot_tahapan = $demplot->demplot_tahapan;
                $this->demplot_sesi = $demplot->demplot_sesi;
                $this->jenis_pupuk = $demplot->jenis_pupuk;

                $this->createDemplot = false;
                $this->updateDemplot = true;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Ada yang salah nih');
        }
    }

    public function update()
    {
        //$this->validate();

        try {
            mDemplotMas::where('demplot_id', $this->demplot_id)->update([
                'tgl_bukti' => $this->tgl_bukti,
                'demplot_luas' => $this->demplot_luas,
                'demplot_pohon' => $this->demplot_pohon,
                'demplot_tahapan' => $this->demplot_tahapan,
                'demplot_sesi' => $this->demplot_sesi,
                'jenis_pupuk' => $this->jenis_pupuk,

            ]);
            $this->dDemplot = mDemplotMas::where('kebun_id', $this->kebun_id)->get();
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFields();
            $this->updateDemplot = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data' . $ex);
        }
    }

    public function detailPohon($demplot_id)
    {
        $dDemplotMas = mDemplotMas::where('demplot_id', $demplot_id)->first();
        $this->demplotDet = mDemplotDet::where('demplot_id', $dDemplotMas->demplot_id)->get();
        $this->hitung = count($this->demplotDet);
        $this->demplot_pohon_h = $dDemplotMas->demplot_pohon;
        $this->no_bukti_v =  $dDemplotMas->no_bukti;
        $this->kebun_id_v = $dDemplotMas->kebun_id;
        $this->kebun_id = $dDemplotMas->kebun_id;
        $this->demplot_id_v = $demplot_id;
        $this->pelanggan_name_v = $dDemplotMas->kebun->pelanggan->pelanggan_name;
        $this->pohondetail = true;
    }

    public function resetFieldsPohon()
    {
        $this->demplot_id = '';
        $this->pelanggan_name = '';
        $this->jumlah_pelapah = '';
        $this->jumlah_tandan = '';
        $this->no_pohon = '';
        $this->pohon_usia = '';
        $this->bakal_tandan = '';
        $this->spiral = '';
        $this->buah_dompet = '';
        $this->kebun_id = '';
        $this->no_bukti = '';
        $this->tgl_bukti = '';
    }

    public function cancelPohonF()
    {
        $this->resetPohonF();
        $this->updateDempDet = false;
    }

    public function resetPohonF()
    {
        $this->demplot_id = '';
        $this->pelanggan_name = '';
        $this->jumlah_pelapah = '';
        $this->jumlah_tandan = '';
        $this->no_pohon = '';
        $this->pohon_usia = '';
        $this->bakal_tandan = '';
        $this->spiral = '';
        $this->buah_dompet = '';
        $this->kebun_id = '';
        $this->no_bukti = '';
        $this->tgl_bukti = '';
        $this->detail_id = '';
    }

    public function editPohon($id, $pohon = '', $dmp_bukti = '', $dmp_id = '')
    {
        try {
            if ($id == '-') {
                $this->detail_id = '';
                $this->demplot_id = $dmp_id;
                $this->no_pohon = $pohon;
                $this->no_bukti = $dmp_bukti;
                $this->pohon_usia = '';
                // $this->tgl_bukti = $demplotDet->tgl_bukti;
                $this->kebun_id = $this->kebun_id;
                $this->pelanggan_name = $this->pelanggan_name;
                $this->jumlah_pelapah = '';
                $this->jumlah_tandan = '';
                $this->bakal_tandan = '';
                $this->spiral = '';
                $this->buah_dompet = '';
                $this->updateDempDet = true;
            } else {
                $demplotDet =  mDemplotDet::findOrfail($id);
                if (!$demplotDet) {
                    session()->flash('error', 'Data Tidak Ditemukan');
                } else {
                    $this->detail_id = $demplotDet->detail_id;
                    $this->demplot_id = $demplotDet->demplot_id;
                    $gNoPohon = explode('/', $demplotDet->no_pohon);
                    $this->no_pohon = $gNoPohon[1];
                    $this->no_bukti = $demplotDet->demplotmaster->no_bukti;
                    $this->pohon_usia = $demplotDet->pohon_usia;
                    $this->tgl_bukti = $demplotDet->tgl_bukti;
                    $this->kebun_id = $demplotDet->demplotmaster->kebun_id;
                    $this->pelanggan_name = $demplotDet->demplotmaster->kebun->pelanggan->pelanggan_name;
                    $this->jumlah_pelapah = $demplotDet->jumlah_pelapah;
                    $this->jumlah_tandan = $demplotDet->jumlah_tandan;
                    $this->bakal_tandan = $demplotDet->bakal_tandan;
                    $this->spiral = $demplotDet->spiral;
                    $this->buah_dompet = $demplotDet->buah_dompet;

                    $this->updateDempDet = true;
                }
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Ada yang salah nih' . $ex);
        }
    }

    public function storePohon()
    {
        //$this->validate();

        try {
            mDemplotDet::create([
                'demplot_id' => $this->demplot_id,
                'no_pohon' => $this->no_bukti . '/' . $this->no_pohon,
                'pohon_usia' => $this->pohon_usia,
                'jumlah_pelapah' => $this->jumlah_pelapah,
                'jumlah_tandan' => $this->jumlah_tandan,
                'bakal_tandan' => $this->bakal_tandan,
                'spiral' => $this->spiral,
                'buah_dompet' => $this->buah_dompet,
            ]);
            $dDemplotMas = mDemplotMas::where('demplot_id', $this->demplot_id)->first();
            $this->demplotDet = mDemplotDet::where('demplot_id', $this->demplot_id)->get();
            $this->hitung = count($this->demplotDet);
            $this->demplot_pohon_h = $dDemplotMas->demplot_pohon;

            session()->flash('success', 'Berhasil Menambahkan Data');
            $this->resetFieldsPohon();
            $this->updateDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data' . $ex);
        }
    }

    public function updatePohon()
    {
        //$this->validate();

        try {
            mDemplotDet::where('detail_id', $this->detail_id)->update([
                'jumlah_pelapah' => $this->jumlah_pelapah,
                'no_pohon' => $this->no_bukti . '/' . $this->no_pohon,
                'pohon_usia' => $this->pohon_usia,
                'jumlah_tandan' => $this->jumlah_tandan,
                'bakal_tandan' => $this->bakal_tandan,
                'spiral' => $this->spiral,
                'buah_dompet' => $this->buah_dompet,
            ]);
            $dDemplotMas = mDemplotMas::where('demplot_id', $this->demplot_id)->first();
            $this->demplotDet = mDemplotDet::where('demplot_id', $dDemplotMas->demplot_id)->get();
            $this->hitung = count($this->demplotDet);
            $this->demplot_pohon_h = $dDemplotMas->demplot_pohon;

            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFieldsPohon();
            $this->updateDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data' . $ex);
        }
    }

    public function destroyPohon($id, $demplot_id = '')
    {
        try {
            if ($id == '-') {
                session()->flash('error', 'Data tidak ada karen belum disimpan di database');
            } else {
                mDemplotDet::where('detail_id', $id)->update([
                    'jumlah_pelapah' => 0,
                    'pohon_usia' => 0,
                    'jumlah_tandan' => 0,
                    'bakal_tandan' => 0,
                    'spiral' => 0,
                    'buah_dompet' => 0,
                ]);
                $dDemplotMas = mDemplotMas::where('demplot_id', $demplot_id)->first();
                $this->demplotDet = mDemplotDet::where('demplot_id', $demplot_id)->get();
                $this->hitung = count($this->demplotDet);
                $this->demplot_pohon_h = $dDemplotMas->demplot_pohon;
                session()->flash('success', 'Berhasil Menghapus Data');
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menghapus Data' . $ex);
        }
    }

    public function demplotShow($kebun_id)
    {
        $this->dDemplot = mDemplotMas::where('kebun_id', $kebun_id)->get();
        $this->showDemplot = true;
        $this->visible = false;
        $this->unVisible = true;
        $this->id_tampil = $kebun_id;
    }

    public function demplotClose()
    {
        $this->dDemplot = mDemplotMas::where('kebun_id', $this->kebun_id)->get();
        $this->dDemplot = [];
        $this->showDemplot = false;
        $this->visible = true;
    }
}
