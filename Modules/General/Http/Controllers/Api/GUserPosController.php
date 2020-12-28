<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GUserPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\General\Services\RolePermissionService;
use Modules\General\Http\Requests\GUserPos\RecoverBarAuthCodeRequest;
use Modules\General\Services\GUserPos\BarAuthCodeService;
use Modules\General\Services\GUserPos\CrudUserService;
use Modules\General\Http\Requests\GUserPos\CreateGUserRequest;
use Modules\General\Http\Requests\GUserPos\EditGUserRequest;
use Modules\General\Filters\GUserPos\FiltersGUserPerRole;
use Modules\General\Filters\GUserPos\FiltersGUserRut;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\General\Filters\GUserPos\FiltersGUserSearch;

class GUserPosController extends Controller
{
    /** @var RolePermissionService $rolePermissionService */
    private $rolePermissionService;

    /** @var BarAuthCodeService $barAuthCodeService */
    private $barAuthCodeService;

    /** @var CrudUserService $crudUserService */
    private $crudUserService;

    /**
     * Constructor
     *
     * @param RolePermissionService $rolePermissionService
     */
    public function __construct(
        RolePermissionService $rolePermissionService,
        BarAuthCodeService $barAuthCodeService,
        CrudUserService $crudUserService
    )
    {
        $this->rolePermissionService = $rolePermissionService;
        $this->barAuthCodeService = $barAuthCodeService;
        $this->crudUserService = $crudUserService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(GUserPos::where('g_user_pos.flag_delete', 0))
                            ->allowedIncludes('hr_employee_pos')
                            ->allowedFilters(
                                'firstnames',
                                'last_name1',
                                'last_name2',
                                'email',
                                Filter::custom('role', FiltersGUserPerRole::class),
                                Filter::custom('rut', FiltersGUserRut::class),
                                Filter::custom('search', FiltersGUserSearch::class)
                            )
                            ->allowedAppends('commissions', 'discount', 'is_ground_seller', 'customers')
                            ->defaultSort('updated_at')
                            ->allowedSorts('auth_code');
                            
        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGUserRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->crudUserService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idGUser)
    {
        return QueryBuilder::for(GUserPos::where('id', $idGUser))
                            ->allowedIncludes('hr_employee_pos')
                            ->allowedAppends('commissions', 'discount', 'is_ground_seller', 'customers')
                            ->first();
    }

    /**
     * Check if user is authorized to perform an action
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function isAuthorized(Request $request)
    {
        $response = $this->rolePermissionService->isAuthorized($request);
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Check if user is bar authorized to perform an action
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function isBarAuthorized(Request $request)
    {
        $response = $this->rolePermissionService->isBarAuthorized($request);
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Recover barcode auth code from a user with role $role
     *
     * @param string $role
     * @param RecoverBarAuthCodeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function recoverBarAuthCode($role, RecoverBarAuthCodeRequest $request)
    {
        $response = $this->barAuthCodeService->recoverBarAuthCode($role, $request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditGUserRequest  $request
     * @param  integer  $gUser
     * @return \Illuminate\Http\Response
     */
    public function update(EditGUserRequest $request, $idUser)
    {
        $response = DB::transaction(function() use (&$request, $idUser) {
            $resp = $this->crudUserService->update($idUser, $request);
            return CustomResponse::ok(['message' => 'Actualizado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $gUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUser)
    {
        $response = DB::transaction(function() use ($idUser) {
            $resp = $this->crudUserService->delete($idUser);
            return CustomResponse::ok(['message' => 'Eliminado con éxito']);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
