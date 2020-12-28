<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailOrderer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailOrdererController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailOrderer::orderBy('id'))
                                ->allowedIncludes('wh_orderer', 'wh_product')
                                //->allowedFilters([''])
                                ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else
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
    * @param  int $idWhDetailOrderer
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailOrderer)
    {
        return QueryBuilder::for(WhDetailOrderer::where('id', $idWhDetailOrderer))
                            ->allowedIncludes('wh_orderer', 'wh_product')
                            ->first();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailOrderer  $whDetailOrderer
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailOrderer $whDetailOrderer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailOrderer  $whDetailOrderer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailOrderer $whDetailOrderer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailOrderer  $whDetailOrderer
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailOrderer $whDetailOrderer)
    {
        //
    }
}
