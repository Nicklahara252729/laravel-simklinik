<?php

namespace App\Repositories\Region\Provinsi;

/**
 * import component
 */

use App\Exceptions\CustomException;

/**
 * import models
 */

use App\Models\Region\Provinces;

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

use App\Repositories\Region\Provinsi\ProvinsiRepositories;

class EloquentProvinsiRepositories implements ProvinsiRepositories
{
    use Message, Response;

    protected $checkerHelper;
    protected $provinces;

    public function __construct(
        Provinces $provinces,
        CheckerHelpers $checkerHelper
    ) {
        /**
         * initialize models
         */
        $this->provinces = $provinces;

        /**
         * initialize helper
         */

        $this->checkerHelper = $checkerHelper;
    }

    /**
     * data provinsi
     */
    public function data()
    {
        try {
            $dataProvinsi = $this->provinces->get();
            if (is_null($dataProvinsi)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'provinsi'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $dataProvinsi);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * get data by name
     */
    public function get($name)
    {
        try {
            $checkDataProvinsi = $this->checkerHelper->provinsiChecker(['name' => $name]);
            if (is_null($checkDataProvinsi)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'provinsi'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $checkDataProvinsi);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
