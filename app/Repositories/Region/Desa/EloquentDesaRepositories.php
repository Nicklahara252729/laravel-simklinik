<?php

namespace App\Repositories\Region\Desa;

/**
 * import component
 */

use App\Exceptions\CustomException;

/**
 * import models
 */

use App\Models\Region\Villages;

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

use App\Repositories\Region\Desa\DesaRepositories;

class EloquentDesaRepositories implements DesaRepositories
{
    use Message, Response;

    protected $checkerHelper;
    protected $villages;

    public function __construct(
        Villages $villages,
        CheckerHelpers $checkerHelper
    ) {
        /**
         * initialize models
         */
        $this->villages = $villages;

        /**
         * initialize helper
         */

        $this->checkerHelper = $checkerHelper;
    }

    /**
     * get data by id kecamatan
     */
    public function getIdKecamatan($idKecamatan)
    {
        try {
            $checkDataKecamatan = $this->villages->where(['district_id' => $idKecamatan])->get();
            if (count($checkDataKecamatan) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'desa'), 404]));
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
     * get data by id desa
     */
    public function getIdDesa($idDesa)
    {
        try {
            $checkDataDesa = $this->villages->where(['id' => $idDesa])->get();
            if (count($checkDataDesa) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'desa'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $checkDataDesa);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
