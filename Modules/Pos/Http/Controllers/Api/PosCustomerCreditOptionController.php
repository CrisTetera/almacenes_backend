<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosCustomerCreditOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class PosCustomerCreditOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosCustomerCreditOption::orderBy('id'))
                            ->allowedFilters(
                                'credit_option'
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
    public function show($idPosCustomerCreditOption)
    {
        return  QueryBuilder::for(PosCustomerCreditOption::where('id', $idPosCustomerCreditOption))
                            ->first();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Pos\PosCustomerCreditOption  $posCustomerCreditOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PosCustomerCreditOption $posCustomerCreditOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosCustomerCreditOption  $posCustomerCreditOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosCustomerCreditOption $posCustomerCreditOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosCustomerCreditOption  $posCustomerCreditOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosCustomerCreditOption $posCustomerCreditOption)
    {
        //
    }
}
