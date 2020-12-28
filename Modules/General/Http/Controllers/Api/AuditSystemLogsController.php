<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\AuditSystemLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class AuditSystemLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(AuditSystemLogs::orderBy('id'))
                            ->allowedIncludes('g_user')
                            ->allowedFilters(Filter::exact('g_user_id'))
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
     * @param  \App\Models\AuditSystemLogs  $auditSystemLogs
     * @return \Illuminate\Http\Response
     */
    public function show($idAuditSystemLogs)
    {
        return  QueryBuilder::for(AuditSystemLogs::where('id', $idAuditSystemLogs))
                            ->allowedIncludes('g_user')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuditSystemLogs  $auditSystemLogs
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditSystemLogs $auditSystemLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditSystemLogs  $auditSystemLogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditSystemLogs $auditSystemLogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuditSystemLogs  $auditSystemLogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditSystemLogs $auditSystemLogs)
    {
        //
    }
}
