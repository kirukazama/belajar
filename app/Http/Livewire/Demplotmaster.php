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
    public $updateDemplot = false, $createDemplot = false, $createDempDet = false;
    public $formData, $pelanggan_name_v, $kebun_id_v, $demplot_id_v, $no_bukti_v;
    public $detail_id, $no_pohon, $pohon_usia, $jumlah_pelapah, $jumlah_tandan, $bakal_tandan, $spiral, $buah_dompet;

    public function render()
    {
        $dKebun = mKebun::paginate(5);
        $dDemplot = mDemplotMas::orderBy('tgl_bukti', 'asc')->get();
        return view('livewire.demplotmaster.index')->with(compact('dKebun'))->with(compact('dDemplot'));
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
        $this->resetFields();
        $this->createDemplot = false;
        $this->updateDemplot = false;
        $this->createDempDet = false;
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
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFields();
            $this->updateDemplot = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data' . $ex);
        }
    }

    public function createpohon($demplot_id)
    {
        $this->fill([
            'formData' => collect([[]])
        ]);
        $this->resetFieldsPohon();
        $dDemplotMas = mDemplotMas::where('demplot_id', $demplot_id)->first();
        $demplotDet = mDemplotDet::where('demplot_id', $dDemplotMas->demplot_id)->get();
        $hitung = count($demplotDet);
        if (!empty($demplotDet)) {
            foreach ($demplotDet as $key => $detail) {
                $gNoPohon = explode('/', $detail->no_pohon);
                $this->formData->push([
                    'demplot_id' => $detail->demplot_id,
                    'no_bukti' => $gNoPohon[0],
                    'detail_id' => $detail->detail_id,
                    'no_pohon' => $gNoPohon[1],
                    'pohon_usia' => $detail->pohon_usia,
                    'jumlah_pelapah' => $detail->jumlah_pelapah,
                    'jumlah_tandan' => $detail->jumlah_tandan,
                    'bakal_tandan' => $detail->bakal_tandan,
                    'spiral' => $detail->spiral,
                    'buah_dompet' => $detail->buah_dompet,
                ]);
            }
        }

        for ($i = 1; $i <= $dDemplotMas->demplot_pohon - $hitung; $i++) {
            $this->formData->push([
                'demplot_id' => $dDemplotMas->demplot_id,
                'no_bukti' => $dDemplotMas->no_bukti,
                'detail_id' => $this->detail_id,
                'no_pohon' => $i + $hitung,
                'pohon_usia' => '',
                'jumlah_pelapah' => '',
                'jumlah_tandan' => '',
                'bakal_tandan' => '',
                'spiral' => '',
                'buah_dompet' => '',
            ]);
        }
        $this->createDempDet = true;
        $this->no_bukti_v = $dDemplotMas->no_bukti;
        $this->kebun_id_v = $dDemplotMas->kebun_id;
        $this->demplot_id_v = $demplot_id;
        $this->pelanggan_name_v = $dDemplotMas->kebun->pelanggan->pelanggan_name;
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

    public function simpanOrupdate()
    {
        //dd($this->formData);
        foreach ($this->formData as $form) {
            if (empty($form['detail_id'])) {
                $this->storePohon($form);
            } else {
                $this->updatePohon($form);
            }
        }
    }

    public function storePohon($form)
    {
        //$this->validate();

        try {
            if (!empty($form['no_pohon']) && !empty($form['pohon_usia']) && !empty($form['jumlah_pelapah']) && !empty($form['jumlah_tandan']) && !empty($form['bakal_tandan']) && !empty($form['spiral']) && !empty($form['buah_dompet'])) {
                mDemplotDet::create([
                    'demplot_id' => $form['demplot_id'],
                    'no_pohon' => $form['no_bukti'] . '/' . $form['no_pohon'],
                    'pohon_usia' => $form['pohon_usia'],
                    'jumlah_pelapah' => $form['jumlah_pelapah'],
                    'jumlah_tandan' => $form['jumlah_tandan'],
                    'bakal_tandan' => $form['bakal_tandan'],
                    'spiral' => $form['spiral'],
                    'buah_dompet' => $form['buah_dompet'],
                ]);
            }
            session()->flash('success', 'Berhasil Menambahkan Data');
            $this->resetFieldsPohon();
            $this->createDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data' . $ex);
        }
    }

    public function updatePohon($form)
    {
        //$this->validate();

        try {
            mDemplotDet::where('detail_id', $form['detail_id'])->update([
                'jumlah_pelapah' => $form['jumlah_pelapah'],
                'no_pohon' => $form['no_bukti'] . '/' . $form['no_pohon'],
                'pohon_usia' => $form['pohon_usia'],
                'jumlah_tandan' => $form['jumlah_tandan'],
                'bakal_tandan' => $form['bakal_tandan'],
                'spiral' => $form['spiral'],
                'buah_dompet' => $form['buah_dompet'],
            ]);
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFieldsPohon();
            $this->createDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data' . $ex);
        }
    }
}
