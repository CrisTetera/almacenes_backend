<?php

namespace Modules\Pos\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Pos\Entities\PosMovementIngressTypePos;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class PosMovementIngressTypePosController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosMovementIngressTypePos::orderBy('id'))
                            ->allowedFilters(
                                'type'
                                )
                            ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idPosCashMovementIngressType)
    {
        return QueryBuilder::for(PosMovementIngressTypePos::where('id', $idPosCashMovementIngressType))
                            ->first();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosMovementIngressTypePos  $posCashMovementIngressType
     * @return \Illuminate\Http\Response
     */
    public function edit(PosMovementIngressTypePos $posCashMovementIngressType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosMovementIngressTypePos  $posCashMovementIngressType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosMovementIngressTypePos $posCashMovementIngressType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosMovementIngressTypePos  $posCashMovementIngressType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosMovementIngressTypePos $posCashMovementIngressType)
    {
        //
    }
}
