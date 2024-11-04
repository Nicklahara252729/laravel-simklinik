<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->authRepositories();
        $this->regionRepositories();
        $this->logRepositories();
        $this->masterDataRepositories();
        $this->pendaftaranRepositories();
        $this->poliklinikRepositories();
        $this->listPasienRepositories();
        $this->profilRepositories();
        $this->dashboardRepositories();
        $this->farmasiRepositories();
    }

    /**
     * auth repositories
     */
    public function authRepositories()
    {
        $this->app->bind(
            'App\Repositories\Auth\Login\LoginRepositories',
            'App\Repositories\Auth\Login\EloquentLoginRepositories'
        );
        $this->app->bind(
            'App\Repositories\Auth\Logout\LogoutRepositories',
            'App\Repositories\Auth\Logout\EloquentLogoutRepositories'
        );
    }

    /**
     * dashboard repositories
     */
    public function dashboardRepositories()
    {
        $this->app->bind(
            'App\Repositories\Dashboard\DashboardRepositories',
            'App\Repositories\Dashboard\EloquentDashboardRepositories'
        );
    }

    /**
     * region repositories
     */
    public function regionRepositories()
    {
        $this->app->bind(
            'App\Repositories\Region\Provinsi\ProvinsiRepositories',
            'App\Repositories\Region\Provinsi\EloquentProvinsiRepositories'
        );
        $this->app->bind(
            'App\Repositories\Region\Kota\KotaRepositories',
            'App\Repositories\Region\Kota\EloquentKotaRepositories'
        );
        $this->app->bind(
            'App\Repositories\Region\Kecamatan\KecamatanRepositories',
            'App\Repositories\Region\Kecamatan\EloquentKecamatanRepositories'
        );
        $this->app->bind(
            'App\Repositories\Region\Desa\DesaRepositories',
            'App\Repositories\Region\Desa\EloquentDesaRepositories'
        );
    }

    /**
     * log repositories
     */
    public function logRepositories()
    {
        $this->app->bind(
            'App\Repositories\Log\LogRepositories',
            'App\Repositories\Log\EloquentLogRepositories'
        );
    }

    /**
     * master data repositories
     */
    public function masterDataRepositories()
    {
        $this->app->bind(
            'App\Repositories\MasterData\Tindakan\TindakanRepositories',
            'App\Repositories\MasterData\Tindakan\EloquentTindakanRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\TindakanKategori\TindakanKategoriRepositories',
            'App\Repositories\MasterData\TindakanKategori\EloquentTindakanKategoriRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\JenisPembayaran\JenisPembayaranRepositories',
            'App\Repositories\MasterData\JenisPembayaran\EloquentJenisPembayaranRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Diagnosa\DiagnosaRepositories',
            'App\Repositories\MasterData\Diagnosa\EloquentDiagnosaRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Laborat\LaboratRepositories',
            'App\Repositories\MasterData\Laborat\EloquentLaboratRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\LaboratKategori\LaboratKategoriRepositories',
            'App\Repositories\MasterData\LaboratKategori\EloquentLaboratKategoriRepositories'
        );

        $this->app->bind(
            'App\Repositories\MasterData\Poli\PoliRepositories',
            'App\Repositories\MasterData\Poli\EloquentPoliRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Pegawai\PegawaiRepositories',
            'App\Repositories\MasterData\Pegawai\EloquentPegawaiRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Pengguna\PenggunaRepositories',
            'App\Repositories\MasterData\Pengguna\EloquentPenggunaRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Faskes\FaskesRepositories',
            'App\Repositories\MasterData\Faskes\EloquentFaskesRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Kamar\KamarRepositories',
            'App\Repositories\MasterData\Kamar\EloquentKamarRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\SatuanObat\SatuanObatRepositories',
            'App\Repositories\MasterData\SatuanObat\EloquentSatuanObatRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\KlasifikasiObat\KlasifikasiObatRepositories',
            'App\Repositories\MasterData\KlasifikasiObat\EloquentKlasifikasiObatRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\JadwalPoli\JadwalPoliRepositories',
            'App\Repositories\MasterData\JadwalPoli\EloquentJadwalPoliRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\Role\RoleRepositories',
            'App\Repositories\MasterData\Role\EloquentRoleRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\PetugasPoli\PetugasPoliRepositories',
            'App\Repositories\MasterData\PetugasPoli\EloquentPetugasPoliRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\DataObat\DataObatRepositories',
            'App\Repositories\MasterData\DataObat\EloquentDataObatRepositories'
        );
        $this->app->bind(
            'App\Repositories\MasterData\DataSpesialis\DataSpesialisRepositories',
            'App\Repositories\MasterData\DataSpesialis\EloquentDataSpesialisRepositories'
        );
    }

    /**
     * pendaftaran
     */
    public function pendaftaranRepositories()
    {
        $this->app->bind(
            'App\Repositories\Pendaftaran\PendaftaranPasien\PendaftaranPasienRepositories',
            'App\Repositories\Pendaftaran\PendaftaranPasien\EloquentPendaftaranPasienRepositories'
        );
        $this->app->bind(
            'App\Repositories\Pendaftaran\ListPendaftaran\ListPendaftaranRepositories',
            'App\Repositories\Pendaftaran\ListPendaftaran\EloquentListPendaftaranRepositories'
        );
    }

    /**
     * List Pasien repositories
     */
    public function listPasienRepositories()
    {
        $this->app->bind(
            'App\Repositories\ListPasien\PasienIgd\PasienIgdRepositories',
            'App\Repositories\ListPasien\PasienIgd\EloquentPasienIgdRepositories'
        );
        $this->app->bind(
            'App\Repositories\ListPasien\PasienRawatInap\PasienRawatInapRepositories',
            'App\Repositories\ListPasien\PasienRawatInap\EloquentPasienRawatInapRepositories'
        );
        $this->app->bind(
            'App\Repositories\ListPasien\KartuPasien\KartuPasienRepositories',
            'App\Repositories\ListPasien\KartuPasien\EloquentKartuPasienRepositories'
        );
        $this->app->bind(
            'App\Repositories\ListPasien\SuratKeterangan\SuratKeteranganRepositories',
            'App\Repositories\ListPasien\SuratKeterangan\EloquentSuratKeteranganRepositories'
        );
    }

    /**
     * poliklinik repositories
     */
    public function poliklinikRepositories()
    {
        $this->app->bind(
            'App\Repositories\Poliklinik\PoliklinikRepositories',
            'App\Repositories\Poliklinik\EloquentPoliklinikRepositories'
        );
    }

    /**
     * Profil repositories
     */
    public function ProfilRepositories()
    {
        $this->app->bind(
            'App\Repositories\Profil\ProfilRepositories',
            'App\Repositories\Profil\EloquentProfilRepositories'
        );
    }

    /**
     * Resep Repositories
     */
    public function farmasiRepositories()
    {
        $this->app->bind(
            'App\Repositories\Farmasi\Resep\ResepRepositories',
            'App\Repositories\Farmasi\Resep\EloquentResepRepositories'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
