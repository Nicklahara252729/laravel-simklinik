<?php

namespace App\Http\Controllers\API\Web\Pendaftaran\PendaftaranPasien;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\Pendaftaran\PendaftaranPasien\RawatJalan\StorePasienBaruRawatJalanRequest;
use App\Http\Requests\Pendaftaran\PendaftaranPasien\RawatJalan\StorePasienLamaRawatJalanRequest;
use App\Http\Requests\Pendaftaran\PendaftaranPasien\Igd\StorePasienBaruIgdRequest;
use App\Http\Requests\Pendaftaran\PendaftaranPasien\Igd\StorePasienLamaIgdRequest;
use App\Http\Requests\Pendaftaran\PendaftaranPasien\RawatInap\StorePasienBaruRawatInapRequest;
use App\Http\Requests\Pendaftaran\PendaftaranPasien\RawatInap\StorePasienLamaRawatInapRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\Pendaftaran\PendaftaranPasien\PendaftaranPasienRepositories;
use App\Repositories\Log\LogRepositories;

class PendaftaranPasienController extends Controller
{
    use Message;

    private $pendaftaranPasienRepositories;
    private $logRepositories;

    public function __construct(
        PendaftaranPasienRepositories $pendaftaranPasienRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->pendaftaranPasienRepositories = $pendaftaranPasienRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * get data by no rm
     */
    public function get($noRm)
    {
        /**
         * process to database
         */
        $response = $this->pendaftaranPasienRepositories->get($noRm);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'autocomplete pendaftaran', 'no rekam medis :' . $noRm);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data pasien baru rawat jalan
     */
    public function storePasienBaruRawatJalan(
        StorePasienBaruRawatJalanRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->pendaftaranPasienRepositories->storePasienBaruRawatJalan($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pendaftaran pasien baru rawat jalan ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data pasien lama rawat jalan
     */
    public function storePasienLamaRawatJalan(
        StorePasienLamaRawatJalanRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->pendaftaranPasienRepositories->storePasienLamaRawatJalan($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pendaftaran pasien lama rawat jalan ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data pasien baru igd
     */
    public function storePasienBaruIgd(
        StorePasienBaruIgdRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->pendaftaranPasienRepositories->storePasienBaruIgd($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pendaftaran pasien baru igd ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data pasien lama igd
     */
    public function storePasienLamaIgd(
        StorePasienLamaIgdRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->pendaftaranPasienRepositories->storePasienLamaIgd($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pendaftaran pasien baru igd ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data pasien baru rawat inap
     */
    public function storePasienBaruRawatInap(
        StorePasienBaruRawatInapRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->pendaftaranPasienRepositories->storePasienBaruRawatInap($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pendaftaran pasien baru rawat inap ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data pasien lama rawat inap
     */
    public function storePasienLamaRawatInap(
        StorePasienLamaRawatInapRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->pendaftaranPasienRepositories->storePasienLamaRawatInap($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pendaftaran pasien lama rawat inap ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }
}