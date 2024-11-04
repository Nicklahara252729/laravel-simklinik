<?php

namespace App\Repositories\MasterData\Role;

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

use App\Models\MasterData\Role\Role;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Role\RoleRepositories;

class EloquentRoleRepositories implements RoleRepositories
{
    use Message, Response;

    private $role;
    private $roleAsR1;
    private $checkerHelpers;
    private $days;

    public function __construct(
        Role $role,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->role = $role;
        $this->roleAsR1 = DB::table('role as r1');

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->days = daysAttribute();
    }

    /**
     * all record
     */
    public function data()
    {
        try {

            /**
             * data role
             */
            $data = $this->roleAsR1->select(
                'r1.uuid_role as uuid_role',
                'r1.menu as menu',
                'r2.menu as parent',
                'r1.icon',
                'r1.link',
                'r1.superadmin',
                'r1.admin_dinas',
                'r1.admin_faskes',
                'r1.operator',
                'r1.dokter',
                'r1.staff',
                'r1.pasien',
            )
                ->leftJoin('role as r2', 'r1.parent', '=', 'r2.uuid_role')
                ->get();

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'role'), 404]));
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
     * get data by uuid
     */
    public function get($uuidRole)
    {
        try {
            /**
             * get single data
             */

            $getData = $this->checkerHelpers->roleChecker(["uuid_role" => $uuidRole]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'role'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getData);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * get data by level
     */
    public function getByLevel($level)
    {
        try {
            /**
             * get single data
             */

            $checkLevel = levelValidationAttribute($level);
            if ($checkLevel == false) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'level'), 404]));
            endif;

            $data = $this->roleAsR1->select(
                'r1.menu as menu',
                'r2.menu as parent',
                'r1.icon',
                'r1.link',
                'r1.uuid_role'
            )
                ->leftJoin('role as r2', 'r1.parent', '=', 'r2.uuid_role')
                ->where('r1.' . $level, 1)
                ->get();

            /**
             * set parent to array
             */
            $getParent = $this->role->select('menu', 'parent')
                ->whereIn('uuid_role', function ($query) {
                    $query->select(DB::raw('DISTINCT parent'))
                        ->from('role')
                        ->whereNotNull('parent');
                })->get();
            $getParent = $this->parentItem($getParent);

            // Organisir data ke dalam struktur yang sesuai
            $menuItems = [];
            foreach ($data as $role) {
                $menuItem = [
                    'menu' => $role->menu,
                    'link' => $role->link,
                    'icon' => $role->icon,
                ];

                // Jika memiliki submenu, tambahkan submenu
                if (in_array($role->menu, $getParent)) {
                    $submenu = $this->getSubmenuItems($data, $role->menu);
                    if (!empty($submenu)) {
                        $menuItem['submenu'] = $submenu;
                    }
                }

                // Tambahkan ke hasil hanya jika bukan submenu
                if (empty($role->parent)) {
                    $menuItems[] = $menuItem;
                }
            }

            /**
             * khusus perawat
             */
            $menuPerawat = [];
            if (authAttribute()['role'] == 'perawat') :
                /**
                 * get role link user
                 */
                $getRoleLinkUser = $this->role->select('menu', 'link', 'icon')
                    ->join('role_link_user', 'role.uuid_role', '=', 'role_link_user.uuid_role')
                    ->where(['role_link_user.uuid_user' => authAttribute()['id']])
                    ->first();
                if (!is_null($getRoleLinkUser)) :
                    
                    $set = [
                        'menu' => $getRoleLinkUser->menu,
                        'link' => $getRoleLinkUser->link,
                        'icon' => $getRoleLinkUser->menu == 'Pasien IGD' ? 'user' : $getRoleLinkUser->icon
                    ];
                    array_push($menuPerawat, $set);
                endif;
            endif;
            $allMenu = array_merge($menuItems, $menuPerawat);

            if (count($allMenu) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'role'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $allMenu);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * create sub menu
     */
    protected function getSubmenuItems($roles, $parentMenu)
    {
        $submenu = [];
        foreach ($roles as $role) {
            if ($role->parent === $parentMenu) {
                $submenuItem = [
                    'menu' => $role->menu,
                    'link' => $role->link,
                    'icon' => $role->icon,
                ];

                // Jika memiliki submenu, tambahkan submenu
                $submenuSubmenu = $this->getSubmenuItems($roles, $role->menu);
                if (!empty($submenuSubmenu)) {
                    $submenuItem['submenu'] = $submenuSubmenu;
                }

                $submenu[] = $submenuItem;
            }
        }

        return $submenu;
    }

    /**
     * filter only parent item
     */
    protected function parentItem($data)
    {
        $data = json_decode($data, true);
        $filteredData = array_filter($data, function ($item) {
            return $item['parent'] === null;
        });

        // Hapus properti "parent" dari setiap objek
        $filteredDataWithoutParent = array_map(function ($item) {
            unset($item['parent']);
            return $item;
        }, $filteredData);

        // Konversi hasil filter ke dalam array indeks
        $filteredDataWithoutParent = array_values($filteredDataWithoutParent);
        $indexedData = [];
        foreach ($filteredDataWithoutParent as $item) {
            $indexedData[] = $item['menu'];
        }

        return $indexedData;
    }

    /**
     * store data to db
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            /**
             * save data menu
             */
            $saveData = $this->role->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['menu']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['menu']), 201, null);
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

    /**
     * update data to db
     */
    public function update($request, $uuidRole)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getRole = $this->checkerHelpers->roleChecker(["uuid_role" => $uuidRole]);
            if (is_null($getRole)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'menu'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $update = $this->role->where(['uuid_role' => $uuidRole])->update($request);
            if (!$update) :
                throw new \Exception($this->outputMessage('update fail', $request['menu']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['menu']), 200, null);
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

    /**
     * delete data from db
     */
    public function delete($uuidRole)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->roleChecker(["uuid_role" => $uuidRole]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'menu'), 404]));
            endif;
            $menu  = $getData->menu;

            /**
             * deleted data
             */
            $delete = $this->role->where('uuid_role', $uuidRole)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $menu));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $menu), 200);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
