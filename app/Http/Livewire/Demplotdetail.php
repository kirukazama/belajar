<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Demplotmaster as mDemplotMas;
use App\Models\Demplotdetail as mDemplotDet;

class Demplotdetail extends Component
{
    public $detail_id, $demplot_id, $no_pohon, $pohon_usia, $jumlah_pelapah, $jumlah_tandan, $bakal_tandan, $spiral, $buah_dompet, $demplot_pohon;
    public $pelanggan_name, $kebun_id, $no_bukti, $tgl_bukti;
    public $updateDempDet = false, $createDempDet = false;
    public $formData, $pelanggan_name_v, $kebun_id_v, $demplot_id_v, $no_bukti_v;

    public function render()
    {
        $dDemplotMas = mDemplotMas::orderBy('tgl_bukti', 'asc')->paginate(8);
        $dDemplotDet = mDemplotDet::get();
        return view('livewire.demplotdetail.index')->with(compact('dDemplotMas'))->with(compact('dDemplotDet'));
    }

    public function create($demplot_id)
    {
        $this->fill([
            'formData' => collect([[]])
        ]);
        $this->resetFields();
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
        $this->updateDempDet = false;
        $this->no_bukti_v = $dDemplotMas->no_bukti;
        $this->kebun_id_v = $dDemplotMas->kebun_id;
        $this->demplot_id_v = $demplot_id;
        $this->pelanggan_name_v = $dDemplotMas->kebun->pelanggan->pelanggan_name;
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

    public function simpanOrupdate()
    {
        //dd($this->formData);
        foreach ($this->formData as $form) {
            if (empty($form['detail_id'])) {
                $this->store($form);
            } else {
                $this->update($form);
            }
        }
    }

    public function store($form)
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
            $this->resetFields();
            $this->createDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Menambahkan Data' . $ex);
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
            session()->flash('error', 'Ada yang salah nih' . $ex);
        }
    }

    public function update($form)
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
            $this->resetFields();
            $this->updateDempDet = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Gagal Mengubah Data' . $ex);
        }
    }
}
