<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kebun as mKebun;
use App\Models\Pelanggan as mPelanggan;
use App\Models\Provinsi as mProvinsi;
use App\Models\Kabkot as mKabkot;
use App\Models\Kecamatan as mKec;
use App\Models\Keldes as mKeldes;
use Livewire\WithPagination;

class Kebun extends Component
{

    use WithPagination;
    public $kebun_id, $kebun_luas, $kebun_pohon, $koordinat, $tanah_jenis, $tanah_kontur, $pelanggan_id, $pelanggan_name, $id_tampil, $kebun_alamat, $keldes_id;
    public $updateKebun, $createKebun, $showKebun, $unVisible = false;
    public $visible = true;
    public $dKebun = [];
    public $cmbProv;
    public $provinsi;
    public $cmbkabkot;
    public $cmbKec;
    public $cmbKelDes;
    public $selectedprovinsi = null;
    public $selectedkabkot = null;
    public $selectedkec = null;

    public function render()
    {
        $dPelanggan = mPelanggan::paginate(5);
        return view('livewire.kebun.index')->with(compact('dPelanggan')); //->with(compact('dKebun'))
    }

    public function create($pelanggan_id)
    {
        $dPelanggan = mPelanggan::where('pelanggan_id', $pelanggan_id)->first();
        $dCmbProv = mProvinsi::select('provinsi_id', 'provinsi_name')->orderBy('provinsi_name','asc')->get();
        $this->cmbProv = $dCmbProv;
        $this->resetFields();
        $this->createKebun = true;
        $this->updateKebun = false;
        $this->pelanggan_id = $pelanggan_id;
        $this->pelanggan_name = $dPelanggan->pelanggan_name;
    }

    public function resetFields()
    {
        $this->pelanggan_id = '';
        $this->pelanggan_name = '';
        $this->kebun_luas = '';
        $this->kebun_pohon = '';
        $this->koordinat = '';
        $this->tanah_jenis = ''; 
        $this->tanah_kontur = '';
    }

    public function cancel()
    {
        $this->dKebun = mKebun::where('pelanggan_id', $this->pelanggan_id)->get();
        $this->resetFields();
        $this->createKebun = false;
        $this->updateKebun = false;
        $this->unVisible = false;
    }

    public function kebunShow($pelanggan_id){
        $this->dKebun = mKebun::where('pelanggan_id', $pelanggan_id)->get();
        $this->showKebun = true;
        $this->visible = false;
        $this->unVisible = true;
        $this->id_tampil = $pelanggan_id;
    }

    public function kebunClose(){
        $this->dKebun = [];
        $this->showKebun = false;
        $this->visible = true;
    }

    public function store()
    {
        //$this->validate();

        try {
            mKebun::create([
                'pelanggan_id' => $this->pelanggan_id,
                'kebun_luas' => $this->kebun_luas,
                'kebun_pohon' => $this->kebun_pohon,
                'kebun_alamat' => $this->kebun_alamat,
                'keldes_id' => $this->keldes_id,
                'koordinat' => $this->koordinat,
                'tanah_jenis' => $this->tanah_jenis, 
                'tanah_kontur' => $this->tanah_kontur,
            ]);

            $this->dKebun = mKebun::where('pelanggan_id', $this->pelanggan_id)->get();

            session()->flash('success', 'Berhasil Menambahkan Data');
            $this->resetFields();
            $this->createKebun = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data');
        }
    }

    public function destroy($id, $pelanggan_id)
    {
        try {
            mKebun::findOrfail($id)->delete();
            $this->dKebun = mKebun::where('pelanggan_id', $pelanggan_id)->get();
            session()->flash('success', 'Berhasil Menghapus Data');
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menghapus Data');
        }
    }

    public function edit($id)
    {
        try {
            $kebun = mKebun::findOrfail($id);
            if (!$kebun) {
                session()->flash('error', 'Data Tidak Ditemukan');
            } else {
                $this->kebun_id = $kebun->kebun_id;
                $this->pelanggan_id = $kebun->pelanggan_id;
                $this->pelanggan_name = $kebun->pelanggan->pelanggan_name;
                $this->kebun_luas = $kebun->kebun_luas;
                $this->kebun_pohon = $kebun->kebun_pohon;
                $this->koordinat = $kebun->koordinat;
                $this->kebun_alamat = $kebun->kebun_alamat;
                $this->keldes_id = $kebun->keldes_id;
                $this->tanah_jenis = $kebun->tanah_jenis;
                $this->tanah_kontur = $kebun->tanah_kontur;

                $this->selectedprovinsi = $kebun->keldes->kecamatan->kabkot->provinsi_id;
                $this->selectedkabkot = $kebun->keldes->kecamatan->kabkot_id;
                $this->selectedkec = $kebun->keldes->kec_id;

                $this->cmbProv = mProvinsi::select('provinsi_id', 'provinsi_name')->orderBy('provinsi_name','asc')->get();
                $this->cmbkabkot= mKabkot::where('provinsi_id', $this->selectedprovinsi)->get();
                $this->cmbKec= mKec::where('kabkot_id', $this->selectedkabkot)->get();
                $this->cmbKelDes= mKeldes::where('kec_id', $this->selectedkec)->get();

                $this->createKebun = false;
                $this->updateKebun = true;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Ada yang salah nih <br>'. $ex);
        }
    }

    public function update(){
        //$this->validate();

        try {
            mKebun::where('kebun_id',$this->kebun_id)->update([
                'kebun_luas' => $this->kebun_luas,
                'kebun_pohon' => $this->kebun_pohon,
                'koordinat' => $this->koordinat,
                'pelanggan_id' => $this->pelanggan_id,
                'tanah_jenis' => $this->tanah_jenis,
                'tanah_kontur' => $this->tanah_kontur,

            ]);
            $this->dKebun = mKebun::where('pelanggan_id', $this->pelanggan_id)->get();
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFields();
            $this->updateKebun = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data'. $ex);
        }
    }

    public function updatedSelectedProvinsi() {
        $this->cmbkabkot= mKabkot::where('provinsi_id', $this->selectedprovinsi)->get();
    }

    public function updatedSelectedKabkot() {
        $this->cmbKec= mKec::where('kabkot_id', $this->selectedkabkot)->get();
    }

    public function updatedSelectedKec() {
        $this->cmbKelDes= mKeldes::where('kec_id', $this->selectedkec)->get();
    }
}
