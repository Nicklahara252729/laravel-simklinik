<?php

namespace App\Repositories\Region\Kota;

/**
 * import component
 */

use App\Exceptions\CustomException;

/**
 * import models
 */

use App\Models\Region\Districts;

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

use App\Repositories\Region\Kota\KotaRepositories;

class EloquentKotaRepositories implements KotaRepositories
{
    use Message, Response;

    protected $checkerHelper;
    protected $districts;

    public function __construct(
        Districts $districts,
        CheckerHelpers $checkerHelper
    ) {
        /**
         * initialize models
         */
        $this->districts = $districts;

        /**
         * initialize helper
         */

        $this->checkerHelper = $checkerHelper;
    }

    /**
     * get data by id provinsi
     */
    public function getIdProvinsi($idProvinsi)
    {
        try {
            $checkDataKota = $this->districts->where(['province_id' => $idProvinsi])->get();

            if (count($checkDataKota) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kabupaten kota'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $checkDataKota);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * get data by id kota
     */
    public function getIdKota($idKota)
    {
        try {
            $checkDataKota = $this->districts->where(['id' => $idKota])->get();

            if (count($checkDataKota) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kabupaten kota'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $checkDataKota);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
