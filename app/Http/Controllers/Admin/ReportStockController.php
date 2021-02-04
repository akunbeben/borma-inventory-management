<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportInventoryCreateRequest;
use App\Repositories\Interfaces\Admin\IReportRepository;
use Illuminate\Http\Request;

class ReportStockController extends Controller
{
    protected $reportRepository;
    protected $user;
    private const DOCUMENT_TYPE = 1;

    public function __construct(IReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->user = auth();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->reportRepository->paginated(10, null, null, self::DOCUMENT_TYPE);

        return view('administrators.pages.reports.stock.index', compact('data'));
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
    public function store(ReportInventoryCreateRequest $request)
    {
        $this->reportRepository->create($request->validated(), $this->user->user()->name, self::DOCUMENT_TYPE);
        
        return redirect(route('administrator.reports.stock'))->with('toast_success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
