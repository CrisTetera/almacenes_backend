<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCheck::orderBy('id'))
                            ->allowedIncludes('g_bank', 'sl_customer')
                            ->allowedFilters(
                                Filter::exact('g_bank_id'),
                                Filter::exact('sl_customer_id'),
                                'place',
                                'number')
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
    public function show($idSlCheck)
    {
        return QueryBuilder::for(SlCheck::orderBy('id'))
                            ->allowedIncludes('g_bank', 'sl_customer')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCheck  $slCheck
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCheck $slCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCheck  $slCheck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCheck $slCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCheck  $slCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCheck $slCheck)
    {
        //
    }
}
