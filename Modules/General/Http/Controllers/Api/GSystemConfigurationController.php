<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\GSystemConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class GSystemConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show()
    {
        return QueryBuilder::for(GStateType::class)
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\GSystemConfiguration  $gSystemConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(GSystemConfiguration $gSystemConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\GSystemConfiguration  $gSystemConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GSystemConfiguration $gSystemConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\GSystemConfiguration  $gSystemConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(GSystemConfiguration $gSystemConfiguration)
    {
        //
    }
}
