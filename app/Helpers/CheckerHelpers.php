<?php

namespace App\Helpers;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * import models
 */

use App\Models\User\User;
use App\Models\Region\Villages;
use App\Models\Region\Districts;
use App\Models\Region\Provinces;
use App\Models\Region\Subdistricts;
use App\Models\MasterData\Faskes\Faskes;
use App\Models\MasterData\Diagnosa\Diagnosa;
use App\Models\MasterData\SatuanObat\SatuanObat;
use App\Models\MasterData\Laborat\Laborat\Laborat;
use App\Models\MasterData\PetugasPoli\PetugasPoli;
use App\Models\MasterData\KamarRawatInap\Kamar\Kamar;
use App\Models\MasterData\Tindakan\Tindakan\Tindakan;
use App\Models\MasterData\JenisPembayaran\JenisPembayaran\JenisPembayaran;
use App\Models\MasterData\KlasifikasiObat\KlasifikasiObat;
use App\Models\MasterData\Poliklinik\Poliklinik\Poliklinik;
use App\Models\MasterData\Laborat\LaboratKategori\LaboratKategori;
use App\Models\MasterData\Tindakan\TindakanKategori\TindakanKategori;
use App\Models\MasterData\JadwalPoli\JadwalPoli;
use App\Models\MasterData\Role\Role;
use App\Models\MasterData\DataObat\DataObat;
use App\Models\MasterData\DataSpesialis\DataSpesialis;
use App\Models\Pengaturan\JenisPembayaranLinkFaskes\JenisPembayaranLinkFaskes;
use App\Models\Pendaftaran\DataPribadi\DataPribadi;
use App\Models\MasterData\Pegawai\RoleLinkUser\RoleLinkUser;
use App\Models\MasterData\Pegawai\KamarLinkUser\KamarLinkUser;
use App\Models\MasterData\Pegawai\PoliklinikLinkUser\PoliklinikLinkUser;
use App\Models\MasterData\KamarRawatInap\Bed\Bed;
use App\Models\MasterData\Poliklinik\PoliklinikLinkKlinik\PoliklinikLinkKlinik;
use App\Models\Farmasi\Resep\Resep;
use App\Models\MasterData\Poliklinik\Pemeriksaan\Pemeriksaan;

class CheckerHelpers
{
    function provinsiChecker($data)
    {
        return Provinces::where($data)->first();
    }

    function kotaChecker($data)
    {
        return Districts::where($data)->first();
    }

    function kecamatanChecker($data)
    {
        return Subdistricts::where($data)->first();
    }

    function desaChecker($data)
    {
        return Villages::where($data)->first();
    }

    function userChecker($data)
    {
        $data = User::select(
            'users.*',
            DB::raw('CASE WHEN photo IS NULL THEN CONCAT("' . url(path('user')) . '/", "blank.png") ELSE CONCAT("' . url(path('user')) . '/", photo) END AS photo'),
            'faskes.nama as nama_faskes',
            'faskes.alamat as alamat_faskes',
            'pegawai.*'
        )
            ->leftJoin('pegawai', 'users.uuid_user', '=', 'pegawai.uuid_user')
            ->leftJoin('faskes', 'users.uuid_faskes', '=', 'faskes.uuid_faskes')
            ->where($data)
            ->first();
        return $data;
    }

    function tindakanKategoriChecker($data)
    {
        return TindakanKategori::where($data)->first();
    }

    function tindakanChecker($data)
    {
        return Tindakan::where($data)->first();
    }

    function jenisPembayaranChecker($data)
    {
        return JenisPembayaran::where($data)->first();
    }

    function diagnosaChecker($data)
    {
        return Diagnosa::where($data)->first();
    }

    function laboratKategoriChecker($data)
    {
        return LaboratKategori::where($data)->first();
    }

    function laboratChecker($data)
    {
        return Laborat::where($data)->first();
    }

    function poliklinikChecker($data)
    {
        return Poliklinik::where($data)->first();
    }

    function faskesChecker($data)
    {
        return Faskes::where($data)->first();
    }

    function kamarChecker($data)
    {
        return Kamar::join('bed', 'kamar.uuid_kamar', '=', 'bed.uuid_kamar')
            ->where($data)
            ->first();
    }

    function satuanObatChecker($data)
    {
        return SatuanObat::where($data)->first();
    }

    function klasifikasiObatChecker($data)
    {
        return KlasifikasiObat::where($data)->first();
    }

    function jadwalPoliChecker($data)
    {
        return JadwalPoli::where($data)->first();
    }

    function roleChecker($data)
    {
        return Role::where($data)->first();
    }

    function petugasPoliChecker($data)
    {
        return PetugasPoli::join('users', 'users.uuid_user', '=', 'petugas_poli.uuid_user')
            ->where($data)
            ->first();
    }

    function dataObatChecker($data)
    {
        return DataObat::where($data)->first();
    }

    function jenisPembayaranLinkFaskesChecker($data)
    {
        return JenisPembayaranLinkFaskes::where($data)->first();
    }

    function pasienChecker($data)
    {
        return DataPribadi::select(
            'data_pribadi.*',
            DB::raw('CASE WHEN foto IS NULL THEN CONCAT("' . url(path('pasien')) . '/", "blank.png")
        ELSE CONCAT("' . url(path('pasien')) . '/", foto) END AS foto')
        )
            ->join('data_penanggung_jawab', 'data_pribadi.uuid_data_pribadi', '=', 'data_penanggung_jawab.uuid_data_pribadi')
            ->orderBy('data_penanggung_jawab.id', 'desc')
            ->where($data)
            ->first();
    }

    function dataSpesialisChecker($data)
    {
        return DataSpesialis::where($data)->first();
    }

    function roleLinkUserChecker($data)
    {
        return RoleLinkUser::where($data)->first();
    }

    function kamarLinkUserChecker($data)
    {
        return KamarLinkUser::where($data)->first();
    }

    function poliklinikLinkUserChecker($data)
    {
        return PoliklinikLinkUser::where($data)->first();
    }

    function bedChecker($data)
    {
        return Bed::where($data)->first();
    }

    function poliklinikLinkKlinikChecker($data)
    {
        return PoliklinikLinkKlinik::where($data)->first();
    }

    function resepChecker($data)
    {
        return Resep::where($data)->first();
    }

    function pemeriksaanChecker($data)
    {
        return Pemeriksaan::where($data)->first();
    }
}
