<?php

namespace App\Repositories\Farmasi\Resep;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\Farmasi\Resep\Resep;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\Farmasi\Resep\ResepRepositories;

class EloquentResepRepositories implements ResepRepositories
{
   use Message, Response;

   private $resep;
   private $checkerHelpers;

   public function __construct(
      Resep $resep,
      CheckerHelpers $checkerHelpers,
   ) {
      /**
       * initialize model
       */
      $this->resep = $resep;

      /**
       * initialize helper
       */
      $this->checkerHelpers = $checkerHelpers;
   }

   /**
    * all record
    */
   public function data()
   {
      try {

         /**
          * data tindakan
          */
         $data = $this->resep->get();
         if (count($data) <= 0) :
            throw new CustomException(json_encode([$this->outputMessage('not found', 'resep'), 404]));
         endif;

         $response = $this->sendResponse(null, 200, $data);
      } catch (CustomException $ex) {
         $ex = json_decode($ex->getMessage());
         $response = $this->sendResponse($ex[0], $ex[1]);
      } catch (\Exception $e) {
         $response = $this->sendResponse($e->getMessage(), 500);
      }
      return $response;
   }

   /**
    * store data to db
    */
   // public function store($request)
   // {
   //    DB::beginTransaction();
   //    try {
   //       /**
   //        * save data resep
   //        */

   //       $saveData = $this->resep->create($request);
   //       if (!$saveData) :
   //          throw new \Exception($this->outputMessage('unsaved', $request['resep']));
   //       endif;

   //       DB::commit();
   //       $response = $this->sendResponse($this->outputMessage('saved', $request['resep']), 201, null);
   //    } catch (CustomException $ex) {
   //       $ex = json_decode($ex->getMessage());
   //       $response = $this->sendResponse($ex[0], $ex[1]);
   //    } catch (\Exception $e) {
   //       DB::rollback();
   //       $response = $this->sendResponse($e->getMessage(), 500);
   //    }

   //    /**
   //     * send response to controller
   //     */
   //    return $response;
   // }
   /**
    * store data to db
    */
   public function store($request)
   {
      DB::beginTransaction();
      try {
         /**
          * save data
          */
         $saveData = $this->resep->create($request);
         if (!$saveData) :
            throw new \Exception($this->outputMessage('unsaved', 'resep'));
         endif;

         DB::commit();
         $response = $this->sendResponse($this->outputMessage('saved', 'resep'), 201, null);
      } catch (CustomException $ex) {
         $ex = json_decode($ex->getMessage());
         $response = $this->sendResponse($ex[0], $ex[1]);
      } catch (\Exception $e) {
         DB::rollback();
         $response = $this->sendResponse($e->getMessage(), 500);
      }

      /**
       * send response to controller
       */
      return $response;
   }
}
