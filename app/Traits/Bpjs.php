<?php

namespace App\Traits;

use AamDsam\Bpjs\PCare;

trait Bpjs{

    private function setConfig(){
        return [
            'cons_id'      => env('BPJS_PCARE_CONSID'),
            'secret_key'   => env('BPJS_PCARE_SCREET_KEY'),
            'username'     => env('BPJS_PCARE_USERNAME'),
            'password'     => env('BPJS_PCARE_PASSWORD'),
            'app_code'     => env('BPJS_PCARE_APP_CODE'),
            'base_url'     => env('BPJS_PCARE_BASE_URL'),
            'service_name' => env('BPJS_PCARE_SERVICE_NAME'),
        ];
    }

    //diagnosa
    protected function diagnosa($keyword, $start = 0, $limit = 2){
        $bpjs = new PCare\Diagnosa($this->pcare_conf());
        return $bpjs->keyword($keyword)->index($start, $limit);
    }

    // dokter
    protected function dokter($start, $limit){
        $bpjs = new PCare\Dokter($this->pcare_conf());
        return $bpjs->index($start, $limit);
    }

    // kesadaran
    protected function kesadaran(){
        $bpjs = new PCare\Kesadaran($this->pcare_conf());
        return $bpjs->index();
    }

    // kunjungan rujukan
    protected function kunjunganRujukan($nomorKunjungan){
        $bpjs = new PCare\Kunjungan($this->pcare_conf());
        return $bpjs->rujukan($nomorKunjungan)->index();
    }

    // kunjungan riwayat
    protected function kunjunganRiwayat($nomorKartu){
        $bpjs = new PCare\Kunjungan($this->pcare_conf());
        return $bpjs->riwayat($nomorKartu)->index();
    }

    // mcu
    protected function mcu($nomorKunjungan){
        $bpjs = new PCare\Mcu($this->pcare_conf());
        return $bpjs->kunjungan($nomorKunjungan)->index();
    }

    // obat dpho
    protected function obatDpho($keyword, $start, $limit){
        $bpjs = new PCare\Obat($this->pcare_conf());
        return $bpjs->dpho($keyword)->index($start, $limit);
    }

    // obat kunjungan
    protected function obatKunjungan($nomorKunjungan){
        $bpjs = new PCare\Obat($this->pcare_conf());
        return $bpjs->kunjungan($nomorKunjungan)->index();
    }

    // pendaftaran tanggal daftar
    protected function registerTanggalDaftar($tglDaftar, $start, $limit){
        $bpjs = new PCare\Pendaftaran($this->pcare_conf());
        return $bpjs->tanggalDaftar($tglDaftar)
            ->index($start, $limit);
    }

    // pendaftaran nomor urut
    protected function registerNomorUrut($nomorUrut, $tanggalDaftar){
        $bpjs = new PCare\Pendaftaran($this->pcare_conf());
        return $bpjs->nomorUrut($nomorUrut)
            ->tanggalDaftar($tanggalDaftar)
            ->index();
    }

    // peserta
    protected function peserta($keyword){
        $bpjs = new PCare\Peserta($this->pcare_conf());
        return $bpjs->keyword($keyword)->show();
    }

    // peserta jenis kartu [NIK/NOKA]
    protected function pesertaJenisKartu($jenisKartu, $keyword){
        $bpjs = new PCare\Peserta($this->pcare_conf());
        return $bpjs->jenisKartu($jenisKartu)
            ->keyword($keyword)
            ->show();
    }

    // poli
    protected function poli($start, $limit){
        $bpjs = new PCare\Poli($this->pcare_conf());
        return $bpjs->fktp()->index($start, $limit);
    }

    // provider
    protected function provider($start, $limit){
        $bpjs = new PCare\provider($this->pcare_conf());
        return $bpjs->index($start, $limit);
    }

    // tindakan kode tkp
    protected function tindakanTkp($keyword, $start, $limit){
        $bpjs = new PCare\Tindakan($this->pcare_conf());
        return $bpjs->kodeTkp($keyword)->index($start, $limit);
    }

    // tindakan kunjungan
    protected function tindakanKunjungan($nomorKunjungan){
        $bpjs = new PCare\Tindakan($this->pcare_conf());
        return $bpjs->kunjungan($nomorKunjungan)->index();
    }

    // kelompok club
    protected function kelompokClub($kodeJenisKelompok){
        $bpjs = new PCare\Kelompok($this->pcare_conf());
        return $bpjs->club($kodeJenisKelompok)->index();
    }

    // kelompok kegiatan
    protected function kelompokKegiatan($bulan){
        $bpjs = new PCare\Kelompok($this->pcare_conf());
        return $bpjs->kegiatan($bulan)->index();
    }

    // kelompok peserta
    protected function kelompokPeserta($eduId){
        $bpjs = new PCare\Kelompok($this->pcare_conf());
        return $bpjs->peserta($eduId)->index();
    }

    // spesialis
    protected function spesialis(){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->index();
    }

    // spesialis sub spesialis
    protected function spesialisSub($keyword){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->keyword($keyword)->subSpesialis()->index();
    }

    // spesialis sarana
    protected function spesialisSarana(){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->sarana()->index();
    }

    // spesialis khusus
    protected function spesialisKhusus(){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->khusus()->index();
    }

    // spesialis rujuk
    protected function spesialisRujukSubSpesialis($kodeSubSpesialis, $kodeSarana, $tanggalRujuk){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->rujuk()
            ->subSpesialis($kodeSubSpesialis)
            ->sarana($kodeSarana)
            ->tanggalRujuk($tanggalRujuk)
            ->index();
    }

    // spesialis rujuk
    protected function spesialisRujukKhusus($kodeKhusus, $nomorKartu, $tanggalRujuk){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->rujuk()
            ->khusus($kodeKhusus)
            ->nomorKartu($nomorKartu)
            ->tanggalRujuk($tanggalRujuk)
            ->index();
    }

    // spesialis rujuk
    protected function spesialisRujukKhususSubSpesialis($kodeKhusus, $kodeSubSpesialis, $nomorKartu, $tanggalRujuk){
        $bpjs = new PCare\Spesialis($this->pcare_conf());
        return $bpjs->rujuk()
            ->khusus($kodeKhusus)
            ->subSpesialis($kodeSubSpesialis)
            ->nomorKartu($nomorKartu)
            ->tanggalRujuk($tanggalRujuk)
            ->index();
    }

}
