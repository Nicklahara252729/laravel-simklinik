<?php

namespace App\Repositories\Region\Kecamatan;

/**
 * import component
 */

use App\Exceptions\CustomException;

/**
 * import models
 */

use App\Models\Region\Subdistricts;

/**
 * import trait
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import repositories
 */

use App\Repositories\Region\Kecamatan\KecamatanRepositories;

class EloquentKecamatanRepositories implements KecamatanRepositories
{
    use Message, Response;

    protected $checkerHelper;
    protected $subdistricts;

    public function __construct(
        Subdistricts $subdistricts,
        CheckerHelpers $checkerHelper
    ) {
        /**
         * initialize models
         */
        $this->subdistricts = $subdistricts;

        /**
         * initialize helper
         */

        $this->checkerHelper = $checkerHelper;
    }

    /**
     * get data by id kota
     */
    public function getIdKota($idKecamatan)
    {
        try {
            $checkDataKecamatan = $this->subdistricts->where(['regency_id' => $idKecamatan])->get();
            if (count($checkDataKecamatan) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kecamatan'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $checkDataKecamatan);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * get data by id kecamatan
     */
    public function getIdKecamatan($idKecamatan)
    {
        try {
            $checkDataKecamatan = $this->subdistricts->where(['id' => $idKecamatan])->get();
            if (count($checkDataKecamatan) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kecamatan'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $checkDataKecamatan);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
