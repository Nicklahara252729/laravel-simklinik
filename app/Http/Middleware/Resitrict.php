<?php

namespace App\Http\Middleware;

/**
 * import component
 */

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * import model
 */

use App\Models\MasterData\Role\Role;

/**
 * import trait
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

class Resitrict
{
    use Message, Response;

    private $checkerHelpers;
    private $role;

    public function __construct(
        Role $role,
        CheckerHelpers $checkerHelpers
    ) {

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * initialize model
         */
        $this->role = $role;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $level = str_replace(' ', '_', Auth::user()->level);

        $getParent = $this->role->select('menu', 'parent')
            ->whereIn('uuid_role', function ($query) {
                $query->select(DB::raw('DISTINCT parent'))
                    ->from('role')
                    ->whereNotNull('parent');
            })->get();
        $getParent = $this->parentItem($getParent);

        $menu = ucwords(str_replace('-', ' ', globalAttribute()['uriSegment3']));
        if (in_array($menu, $getParent)) :            
            $menu = ucwords(str_replace('-', ' ', globalAttribute()['uriSegment4']));
            $menu = $menu == 'Kamar' ? 'Kamar Rawat Inap' : $menu;
        else :
            $menu = $menu;
        endif;

        $levelValidation = $this->role->where(['menu' => $menu, $level => 1])->first();

        if (is_null($levelValidation)) :
            $response = $this->sendResponse($this->outputMessage('forbidden'), 403);
            $code = $response['code'];
            unset($response['code']);
            return response($response, $code);
        endif;

        return $next($request);
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
}
