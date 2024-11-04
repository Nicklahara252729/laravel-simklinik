<?php

namespace App\Http\Controllers\API\Web\Poliklinik;

/**
 * import component
 */

use App\Http\Controllers\Controller;
use App\Http\Requests\Poliklinik\StorePemeriksaanDokterRequest;
use App\Http\Requests\Poliklinik\StorePemeriksaanPerawatRequest;
use Illuminate\Http\Request;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\Poliklinik\PoliklinikRepositories;
use App\Repositories\Log\LogRepositories;

class PoliklinikController extends Controller
{
    use Message;

    private $poliklinikRepositories;
    private $logRepositories;
    private $request;

    public function __construct(
        PoliklinikRepositories $poliklinikRepositories,
        LogRepositories $logRepositories,
        Request $request
    ) {

        /**
         * initialize repositories
         */
        $this->poliklinikRepositories = $poliklinikRepositories;
        $this->logRepositories = $logRepositories;

        /**
         * static value
         */
        $this->request = $request;
    }

    /**
     * all record data
     */
    public function data($uuidPoliklinikLinkKlinik, $uuidFaskes = null)
    {
        /**
         * load data from repositories
         */
        $filter = is_null($this->request->get('filter')) ? null : explode('-', str_replace(' ', '', $this->request->get('filter')));
        $response = $this->poliklinikRepositories->data($uuidPoliklinikLinkKlinik, $uuidFaskes, $filter);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'poliklinik');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid
     */
    public function get($uuidPendaftaran, $uuidFaskes = null)
    {
        /**
         * process to database
         */
        $response = $this->poliklinikRepositories->get($uuidPendaftaran, $uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'poliklinik', 'uuid pendaftaran :' . $uuidPendaftaran);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data for perawat
     */
    public function storePerawat(StorePemeriksaanPerawatRequest $storePemeriksaanRequest)
    {
        /**
         * requesting data
         */
        $storeRequest = $storePemeriksaanRequest->all();

        /**
         * process begin
         */
        $response = $this->poliklinikRepositories->storePerawat($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pemeriksaan ' . json_encode($storeRequest));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data for dokter
     */
    public function storeDokter(StorePemeriksaanDokterRequest $storePemeriksaan)
    {
        /**
         * requesting data
         */
        $storePemeriksaan = $storePemeriksaan->all();

        /**
         * process begin
         */
        $response = $this->poliklinikRepositories->storeDokter($storePemeriksaan);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pemeriksaan ' . json_encode($storePemeriksaan));
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }
}
