<?php

namespace App\Repositories\Log;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\Log\Log;

/**
 * import interface
 */

use App\Repositories\Log\LogRepositories;

class EloquentLogRepositories implements LogRepositories
{
    use Message, Response;

    private $log;

    public function __construct(
        Log $log
    ) {
        /**
         * initialize model
         */
        $this->log = $log;
    }

    /**
     * store data to db
     */
    public function saveLog($action, $keterangan, $uuidUser, $nop)
    {
        DB::beginTransaction();
        try {
            /**
             * save data log
             */
            $data = [
                'action' => $action,
                'keterangan' => $keterangan,
                'uuid_user' => $uuidUser,
            ];
            
            $save = $this->log->create($data);
            if (!$save) :
                throw new \Exception($this->outputMessage('unsaved', $action));
            endif;

            DB::commit();
            $response  = $this->sendResponse($this->outputMessage('saved', $action), 200);
        } catch (\Exception $e) {
            DB::rollback();
            $response  = $this->sendResponse($e->getMessage(), 500);
        }

        /**
         * send response to controller
         */
        return $response;
    }
}
