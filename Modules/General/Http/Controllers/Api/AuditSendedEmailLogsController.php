<?php

namespace Modules\General\Http\Controllers\Api;

use Modules\General\Entities\AuditSendedEmailLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class AuditSendedEmailLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(AuditSendedEmailLogs::orderBy('id'))
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
     * @param  \Modules\General\Entities\AuditSendedEmailLogs  $auditSendedEmailLogs
     * @return \Illuminate\Http\Response
     */
    public function show($idAuditSendedEmailLogs)
    {
        return QueryBuilder::for(AuditSendedEmailLogs::where('id', $idAuditSendedEmailLogs))
                            ->allowedIncludes('g_user')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\AuditSendedEmailLogs  $auditSendedEmailLogs
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditSendedEmailLogs $auditSendedEmailLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\AuditSendedEmailLogs  $auditSendedEmailLogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditSendedEmailLogs $auditSendedEmailLogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\AuditSendedEmailLogs  $auditSendedEmailLogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditSendedEmailLogs $auditSendedEmailLogs)
    {
        //
    }
}
