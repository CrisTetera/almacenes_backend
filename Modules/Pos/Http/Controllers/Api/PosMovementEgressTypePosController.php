<?php

namespace Modules\Pos\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Pos\Entities\PosMovementEgressTypePos;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class PosMovementEgressTypePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosMovementEgressTypePos::orderBy('id'))
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
    public function show($idPosCashMovementEgressType)
    {
        return QueryBuilder::for(PosMovementEgressTypePos::where('id', $idPosCashMovementEgressType))
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosMovementEgressTypePos  $posCashMovementEgressType
     * @return \Illuminate\Http\Response
     */
    public function edit(PosMovementEgressTypePos $posCashMovementEgressType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosMovementEgressTypePos  $posCashMovementEgressType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosMovementEgressTypePos $posCashMovementEgressType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosMovementEgressTypePos  $posCashMovementEgressTypePos
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosMovementEgressTypePos $posCashMovementEgressTypePos)
    {
        //
    }
}
