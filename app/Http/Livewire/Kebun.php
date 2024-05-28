<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kebun as mKebun;
use App\Models\Pelanggan as mPelanggan;
use Livewire\WithPagination;

class Kebun extends Component
{

    use WithPagination;
    public $kebun_id, $kebun_luas, $kebun_pohon, $koordinat, $pelanggan_id, $pelanggan_name, $id_tampil;
    public $updateKebun, $createKebun, $showKebun, $unVisible = false;
    public $visible = true;
    public $dKebun = [];

    public function render()
    {
        $dPelanggan = mPelanggan::paginate(5);
        return view('livewire.kebun.index')->with(compact('dPelanggan')); //->with(compact('dKebun'))
    }

    public function create($pelanggan_id)
    {
        $dPelanggan = mPelanggan::where('pelanggan_id', $pelanggan_id)->first();
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
                'koordinat' => $this->koordinat
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

                $this->createKebun = false;
                $this->updateKebun = true;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Ada yang salah nih');
        }
    }

    public function update(){
        //$this->validate();

        try {
            mKebun::where('kebun_id',$this->kebun_id)->update([
                'kebun_luas' => $this->kebun_luas,
                'kebun_pohon' => $this->kebun_pohon,
                'koordinat' => $this->koordinat,
                'pelanggan_id' => $this->pelanggan_id

            ]);
            $this->dKebun = mKebun::where('pelanggan_id', $this->pelanggan_id)->get();
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFields();
            $this->updateKebun = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data'. $ex);
        }
    }
}
