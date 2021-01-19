<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\Admin\StockInRepository;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    protected $stockInRepository;

    public function __construct(StockInRepository $stockInRepository)
    {
        $this->stockInRepository = $stockInRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchQuery = null;

        if ($request->has('search')) $searchQuery = $request->search;

        $stocks = $this->stockInRepository->paginated(10, ['body.product'], $searchQuery);

        return view('administrators.pages.inventory.stock-in.index', compact('stocks'));
    }

    public function approve($uuid)
    {
        $this->stockInRepository->approve($uuid);

        return redirect(route('administrator.inventory.stock-in'))->with('toast_success', 'Stock in has been approved and stored to inventory.');
    }

    public function reject($uuid)
    {
        $this->stockInRepository->reject($uuid);

        return redirect(route('administrator.inventory.stock-in'))->with('toast_success', 'Stock in has been rejected.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $stock = $this->stockInRepository->getStockInDetail($uuid, ['body', 'body.product']);

        return view('administrators.pages.inventory.stock-in.show', compact('stock'));
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
