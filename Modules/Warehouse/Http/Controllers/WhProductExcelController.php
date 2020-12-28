<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Warehouse\Services\WhProductExcel\WhProductExcelService;

class WhProductExcelController extends Controller
{
    /** @var WhProductExcelService $whProductExcelService */
    private $whProductExcelService;

    public function __construct(WhProductExcelService $whProductExcelService)
    {
        $this->whProductExcelService = $whProductExcelService;
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('warehouse::productexcel/create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use (&$request) {
            $this->whProductExcelService->store($request);
        });
        echo "SI LLEGASTE HASTA AQUÍ, TODO FUNCIONÓ BIEN!<br>";
        die();
    }

}
