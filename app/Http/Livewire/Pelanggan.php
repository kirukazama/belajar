<?php

namespace App\Http\Livewire;

use App\Models\Pelanggan as mPelanggan;
use App\Models\Provinsi as mProvinsi;
use App\Models\Kabkot as mKabkot;
use App\Models\Kecamatan as mKec;
use App\Models\Keldes as mKeldes;
use Livewire\Component;
use Livewire\WithPagination;

class Pelanggan extends Component
{
    public $pelanggan_id, $pelanggan_name, $pelanggan_alamat, $keldes_id, $no_telp, $perusahaan_name, $pimpinan_name, $perusahaan_telp;
    public $provinsi_id;
    public $updatepelanggan = false, $createPelanggan = false;
    public $pelanggan;
    public $cmbProv;
    public $provinsi;
    public $cmbkabkot;
    public $cmbKec;
    public $cmbKelDes;
    public $selectedprovinsi = null;
    public $selectedkabkot = null;
    public $selectedkec = null;
    use WithPagination;
    

    protected $rules = [
        'pelanggan_name' => 'required',
        'pelanggan_alamat' => 'required',
        'keldes_id' => 'required',
        'no_telp' => 'required',
    ];

    public function resetFields()
    {
        $this->pelanggan_id = '';
        $this->pelanggan_name = '';
        $this->pelanggan_alamat = '';
        $this->keldes_id = '';
        $this->no_telp = '';
        $this->perusahaan_name = '';
        $this->pimpinan_name = '';
        $this->perusahaan_telp = '';
    }

    public function render()
    {
        $dPelanggan = mPelanggan::paginate(8);
        return view('livewire.pelanggan.index', compact('dPelanggan'));
    }

    public function create()
    {
        $dCmbProv = mProvinsi::select('provinsi_id', 'provinsi_name')->orderBy('provinsi_name','asc')->get();
        $this->cmbProv = $dCmbProv;
        $this->resetFields();
        $this->createPelanggan = true;
        $this->updatepelanggan = false;
    }

    public function store()
    {
        $this->validate();

        try {
            mPelanggan::create([
                'pelanggan_name' => $this->pelanggan_name,
                'pelanggan_alamat' => $this->pelanggan_alamat,
                'keldes_id' => $this->keldes_id,
                'no_telp' => $this->no_telp,
                'perusahaan_name' => $this->perusahaan_name,
                'pimpinan_name' => $this->pimpinan_name,
                'perusahaan_telp' => $this->perusahaan_telp
            ]);

            session()->flash('success', 'Berhasil Menambahkan Data');
            $this->resetFields();
            $this->createPelanggan = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data');
        }
    }

    public function edit($id)
    {
        try{
            $pelanggan = mPelanggan::findOrfail($id);
            if(!$pelanggan){
                session()->flash('error', 'Data Tidak Ditemukan');
            } else {
                $this->pelanggan_id = $pelanggan->pelanggan_id;
                $this->pelanggan_name = $pelanggan->pelanggan_name;
                $this->pelanggan_alamat = $pelanggan->pelanggan_alamat;
                $this->keldes_id = $pelanggan->keldes_id;
                $this->no_telp = $pelanggan->no_telp;
                $this->perusahaan_name = $pelanggan->perusahaan_name;
                $this->pimpinan_name = $pelanggan->pimpinan_name;
                $this->perusahaan_telp = $pelanggan->perusahaan_telp;

                $this->selectedprovinsi = $pelanggan->keldes->kecamatan->kabkot->provinsi_id;
                $this->selectedkabkot = $pelanggan->keldes->kecamatan->kabkot_id;
                $this->selectedkec = $pelanggan->keldes->kec_id;

                $this->cmbProv = mProvinsi::select('provinsi_id', 'provinsi_name')->orderBy('provinsi_name','asc')->get();
                $this->cmbkabkot= mKabkot::where('provinsi_id', $this->selectedprovinsi)->get();
                $this->cmbKec= mKec::where('kabkot_id', $this->selectedkabkot)->get();
                $this->cmbKelDes= mKeldes::where('kec_id', $this->selectedkec)->get();

                $this->createPelanggan = false;
                $this->updatepelanggan = true;
            }
        } catch (\Exception $ex){
            session()->flash('error', 'Ada yang salah nih');
        }
    }

    public function update(){
        $this->validate();

        try {
            mPelanggan::where('pelanggan_id',$this->pelanggan_id)->update([
                'pelanggan_name' => $this->pelanggan_name,
                'pelanggan_alamat' => $this->pelanggan_alamat,
                'keldes_id' => $this->keldes_id,
                'no_telp' => $this->no_telp,
                'perusahaan_name' => $this->perusahaan_name,
                'pimpinan_name' => $this->pimpinan_name,
                'perusahaan_telp' => $this->perusahaan_telp
            ]);
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFields();
            $this->updatepelanggan = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data'. $ex);
        }
    }

    public function cancel(){
        $this->resetFields();
        $this->createPelanggan = false;
        $this->updatepelanggan = false;
    }

    public function destroy($id){
        try {
            mPelanggan::findOrfail($id)->delete();
            session()->flash('success', 'Berhasil Menghapus Data');
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menghapus Data');
        }
    }

    // public function mount(){
    //     $this->provinsi = mProvinsi::all();
    // }

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
