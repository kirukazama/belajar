<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Demplotmaster as mDemplotMas;
use App\Models\Demplotdetail as mDemplotDet;

class Demplotdetail extends Component
{
    public $detail_id, $demplot_id, $no_pohon, $pohon_usia, $jumlah_pelapah, $jumlah_tandan, $bakal_tandan, $spiral, $buah_dompet;
    public $pelanggan_name, $kebun_id, $no_bukti, $tgl_bukti;
    public $updateDempDet = false, $createDempDet = false;

    public function render()
    {
        $dDemplotMas = mDemplotMas::orderBy('tgl_bukti','asc')->paginate(8);
        $dDemplotDet = mDemplotDet::get();
        return view('livewire.demplotdetail.index')->with(compact('dDemplotMas'))->with(compact('dDemplotDet'));
    }

    public function create($demplot_id)
    {
        $dDemplotMas = mDemplotMas::where('demplot_id', $demplot_id)->first();
        $this->resetFields();
        $this->createDempDet = true;
        $this->updateDempDet = false;
        $this->no_bukti = $dDemplotMas->no_bukti;
        $this->kebun_id = $dDemplotMas->kebun_id;
        $this->demplot_id = $demplot_id;
        $this->pelanggan_name = $dDemplotMas->kebun->pelanggan->pelanggan_name;
    }

    public function resetFields()
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

    public function cancel()
    {
        $this->resetFields();
        $this->updateDempDet = false;
        $this->createDempDet = false;
    }

    public function store()
    {
        //$this->validate();

        try {
            mDemplotDet::create([
                'demplot_id' => $this->demplot_id,
                'no_pohon' => $this->no_bukti.'/'.$this->no_pohon,
                'pohon_usia' => $this->pohon_usia,
                'jumlah_pelapah' => $this->jumlah_pelapah,
                'jumlah_tandan' => $this->jumlah_tandan,
                'bakal_tandan' => $this->bakal_tandan,
                'spiral' => $this->spiral,
                'buah_dompet' => $this->buah_dompet,
            ]);

            session()->flash('success', 'Berhasil Menambahkan Data');
            $this->resetFields();
            $this->createDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data'.$ex);
        }
    }

    public function destroy($id)
    {
        try {
            mDemplotDet::findOrfail($id)->delete();
            session()->flash('success', 'Berhasil Menghapus Data');
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menghapus Data');
        }
    }

    public function edit($id)
    {
        try {
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
                $this->createDempDet = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Ada yang salah nih'. $ex);
        }
    }

    public function update(){
        //$this->validate();

        try {
            mDemplotDet::where('detail_id',$this->detail_id)->update([
                'jumlah_pelapah' => $this->jumlah_pelapah,
                'no_pohon' => $this->no_bukti.'/'.$this->no_pohon,
                'pohon_usia' => $this->pohon_usia,
                'jumlah_tandan' => $this->jumlah_tandan,
                'bakal_tandan' => $this->bakal_tandan,
                'spiral' => $this->spiral,
                'buah_dompet' => $this->buah_dompet,
            ]);
            session()->flash('success', 'Berhasil Mengubah Data');
            $this->resetFields();
            $this->updateDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data'. $ex);
        }
    }
}
