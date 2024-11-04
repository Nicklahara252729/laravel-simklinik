<?php

namespace App\Traits;

/**
 * import helper
 */

use App\Helpers\CheckerHelpers;

trait Message
{
    public function outputMessage(string $type, string $value = null)
    {
        $key  = "type";
        $data = [
            [
                // data ada atau kosong
                'type'    => 'data',
                'message' => ($value > 0) ? "data found" : "data empty"
            ],
            [
                // data tidak ditemukan
                'type'    => 'not found',
                'message' => 'data ' . $value . ' tidak ditemukan'
            ],
            [
                // data berhasil di simpan
                'type'    => 'saved',
                'message' => 'data ' . $value . ' berhasil disimpan'
            ],
            [
                // data berhasil di simpan
                'type'    => 'required',
                'message' => 'data ' . $value . ' tidak boleh kosong'
            ],
            [
                // data gagal disimpan
                'type'    => 'unsaved',
                'message' => 'data ' . $value . ' gagal disimpan'
            ],
            [
                // data berhasil di ubah
                'type'    => 'updated',
                'message' => 'data ' . $value . ' berhasil diubah'
            ],
            [
                // data gagal diubah
                'type'    => 'update fail',
                'message' => 'data ' . $value . ' gagal diubah'
            ],
            [
                // data suda ada
                'type'    => 'exist',
                'message' => 'data ' . $value . ' sudah ada / terdaftar'
            ],
            [
                // data berhasil di hapus
                'type'    => 'deleted',
                'message' => 'data ' . $value . ' berhasil dihapus'
            ],
            [
                // data gagal di hapus
                'type'    => 'undeleted',
                'message' => 'data ' . $value . ' gagal dihapus'
            ],
            [
                // data berhasil di hapus permanen
                'type'    => 'deleted permanent',
                'message' => 'data ' . $value . ' berhasil dihapus permanen'
            ],
            [
                // data gagal di hapus permanen
                'type'    => 'undeleted permanent',
                'message' => 'data ' . $value . ' gagal dihapus permanen'
            ],
            [
                // format file tidak didukung
                'type'    => 'unsupported',
                'message' => 'format file yang di upload tidak didukung'
            ],
            [
                // directori tidak ditemukan
                'type'    => 'directory',
                'message' => 'directori tidak ditemukan'
            ],
            [
                // logout
                'type'    => 'logout',
                'message' => 'Successfully logged out'
            ],
            [
                // restore
                'type'    => 'restore',
                'message' => 'Successfully restore data'
            ],
            [
                // restore fail
                'type'    => 'restore fail',
                'message' => 'unsuccessfully restore data'
            ],
            [
                // pembatasan akses
                'type'    => 'forbidden',
                'message' => 'anda tidak memiliki akses untuk data ini'
            ],
            [
                // invalid data
                'type'    => 'invalid',
                'message' => 'invalid '.$value
            ],
        ];

        $filteredArray = array_filter($data, function ($item) use ($key, $type) {
            return $item[$key] === $type;
        });

        return ucwords(array_values($filteredArray)[0]['message']);
    }

    /**
     * set for log
     */
    protected function setForLog(string $table, string $value)
    {
        try {
            $checkerHelpers = new CheckerHelpers;
            if ($table == 'tindakan') :
                $getData = $checkerHelpers->tindakanChecker(['uuid_tindakan' => $value]);
                $value = 'tindakan ' . $getData->nama;
            elseif ($table == 'tindakan kategori') :
                $getData = $checkerHelpers->tindakanKategoriChecker(['uuid_tindakan_kategori' => $value]);
                $value = 'tindakan kategori ' . $getData->kategori;
            elseif ($table == 'jenis pembayaran' || $table == 'jenis pembayaran is active') :
                $getData = $checkerHelpers->jenisPembayaranChecker(['uuid_jenis_pembayaran' => $value]);
                $value = 'jenis pembayaran ' . $table == 'jenis pembayaran' ? $getData->jenis_pembayaran : $getData->jenis_pembayaran . ' status ' . $getData->is_active;
            elseif ($table == 'diagnosa') :
                $getData = $checkerHelpers->diagnosaChecker(['code' => $value]);
                $value = 'diagnosa ' . $getData->diagnosa;
            elseif ($table == 'laborat') :
                $getData = $checkerHelpers->laboratChecker(['uuid_laborat' => $value]);
                $value = 'laborat ' . $getData->nama;
            elseif ($table == 'laborat kategori') :
                $getData = $checkerHelpers->laboratKategoriChecker(['uuid_laborat_kategori' => $value]);
                $value = 'laborat kategori ' . $getData->kategori;
            elseif ($table == 'poliklinik') :
                $getData = $checkerHelpers->poliklinikChecker(['uuid_poliklinik' => $value]);
                $value = $getData->poliklinik;
            elseif ($table == 'pegawai') :
                $getData = $checkerHelpers->userChecker(['uuid_user' => $value]);
                $value = 'pegawai ' . $getData->name;
            elseif ($table == 'faskes') :
                $getData = $checkerHelpers->faskesChecker(['uuid_faskes' => $value]);
                $value = 'faskes ' . $getData->name;
            elseif ($table == 'kamar') :
                $getData = $checkerHelpers->kamarChecker(['kamar.uuid_kamar' => $value]);
                $value = 'kamar ' . $getData->nama_kamar;
            elseif ($table == 'bed') :
                $getData = $checkerHelpers->kamarChecker(['uuid_bed' => $value]);
                $value = 'bed by uuid' . $getData->uuid_bed;
            elseif ($table == 'jadwal poli') :
                $getData = $checkerHelpers->jadwalPoliChecker(['uuid_jadwal_poli' => $value]);
                $value = json_encode($getData);
            elseif ($table == 'klasifikasi obat') :
                $getData = $checkerHelpers->klasifikasiObatChecker(['uuid_klasifikasi_obat' => $value]);
                $value = 'klasifikasi obat' . $getData->klasifikasi;
            elseif ($table == 'satuan obat') :
                $getData = $checkerHelpers->satuanObatChecker(['uuid_satuan_obat' => $value]);
                $value = 'satuan obat' . $getData->satuan;
            elseif ($table == 'data obat') :
                $getData = $checkerHelpers->dataObatChecker(['uuid_data_obat' => $value]);
                $value = 'obat ' . $getData->nama;
            elseif ($table == 'pengguna') :
                $getData = $checkerHelpers->userChecker(['uuid_user' => $value]);
                $value = 'pengguna ' . $getData->name;
            elseif ($table == 'pasien') :
                $getData = $checkerHelpers->pasienChecker(['data_pribadi.uuid_data_pribadi' => $value]);
                $value = 'pasien' . $getData->nama_pasien;
            elseif ($table == 'spesialis') :
                $getData = $checkerHelpers->dataSpesialisChecker(['uuid_spesialis' => $value]);
                $value = 'spesialis' . $getData->spesialis;
            endif;
        } catch (\Exception $e) {
            $value  = $e->getMessage();
        }

        return $value;
    }

    /**
     * message for log
     */
    public function outputLogMessage(string $type, string $value = null, string $moreValue = null, string $table = null)
    {
        if ($type == 'update' || $type == 'delete') :
            $value = $this->setForLog($table, $value);
        endif;

        $key  = "type";
        $data = [
            [
                // login success
                'type'    => 'login success',
                'action'  => 'login berhasil',
                'message' => 'percobaan login oleh ' . $value
            ],
            [
                // login fail
                'type'    => 'login fail',
                'action'  => 'login gagal',
                'message' => 'akun ' . $value . ' tidak ditemukan'
            ],
            [
                // logout
                'type'    => 'logout',
                'action'  => 'berhasil logout',
                'message' => 'berhasil keluar dari sistem'
            ],
            [
                // validation token
                'type'    => 'validation',
                'action'  => 'validasi token',
                'message' => 'percobaan validasi token user'
            ],
            [
                // refresh token
                'type'    => 'refresh',
                'action'  => 'refresh token',
                'message' => 'percobaan refresh token user'
            ],
            [
                // get all data
                'type'    => 'all data',
                'action'  => 'get all data ' . $value,
                'message' => 'percobaan mengambil semua data ' . $moreValue
            ],
            [
                // get single data
                'type'    => 'single data',
                'action'  => 'get single data ' . $value,
                'message' => 'percobaan mengambil 1 data dengan ' . $moreValue
            ],
            [
                // save data
                'type'    => 'save',
                'action'  => 'save data',
                'message' => 'berhasil menyimpan data ' . $value
            ],
            [
                // update data
                'type'    => 'update',
                'action'  => 'update data ' . $value,
                'message' => 'berhasil mengubah data ' . $value . ' menjadi ' . $moreValue
            ],
            [
                // delete data
                'type'    => 'delete',
                'action'  => 'delete data',
                'message' => 'percobaan menghapus data ' . $value
            ],
            [
                // total data
                'type'    => 'total',
                'action'  => 'get total data',
                'message' => 'mengambil total data ' . $value
            ],
            [
                // search data
                'type'    => 'search',
                'action'  => 'search data ' . $value,
                'message' => 'pencarian data ' . $value . ' berdasarkan ' . $moreValue
            ],
            [
                // generate
                'type'    => 'generate',
                'action'  => 'generate data ' . $value,
                'message' => 'generate data ' . $value . ' value ' . $moreValue
            ],
            [
                // export
                'type'    => 'export',
                'action'  => 'export data',
                'message' => 'export data ' . $value
            ],
            [
                // change password
                'type'    => 'change password',
                'action'  => 'change password',
                'message' => 'change password uuid user ' . $value
            ],
        ];

        $filteredArray = array_filter($data, function ($item) use ($key, $type) {
            return $item[$key] === $type;
        });

        $return = [
            'action' => ucwords(array_values($filteredArray)[0]['action']),
            'message' => ucwords(array_values($filteredArray)[0]['message'])
        ];

        return $return;
    }
}
