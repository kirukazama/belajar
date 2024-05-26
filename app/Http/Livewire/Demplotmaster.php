<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kebun as mKebun;
use App\Models\Demplotmaster as mDemplotMas;
use App\Models\Pelanggan as mPelanggan;

class Demplotmaster extends Component
{

    public $demplot_id, $no_bukti, $tgl_bukti, $pelanggan_id, $pelanggan_name, $kebun_id, $demplot_luas, $demplot_pohon, $demplot_tahapan, $demplot_sesi, $jenis_pupuk;
    public $updateDemplot = false, $createDemplot = false;
    
    public function render()
    {
        $dKebun = mKebun::paginate(5);
        $dDemplot = mDemplotMas::orderBy('tgl_bukti','asc')->get();
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
        $this->no_bukti = 'DMP-'.$this->pelanggan_id.'-'.$this->kebun_id.'-'.$this->unique_code(5);
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
            session()->flash('error', 'Gagal Menambahkan Data'.$ex);
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

    public function update(){
        //$this->validate();

        try {
            mDemplotMas::where('demplot_id',$this->demplot_id)->update([
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
            session()->flash('error', 'Gagal Mengubah Data'. $ex);
        }
    }
}
