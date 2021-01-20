<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\Admin\StockOutRepository;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    protected $stockOutRepository;

    public function __construct(StockOutRepository $stockOutRepository)
    {
        $this->stockOutRepository = $stockOutRepository;
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

        $stocks = $this->stockOutRepository->paginated(10, ['body.product'], $searchQuery);

        return view('administrators.pages.inventory.stock-out.index', compact('stocks'));
    }

    public function approve($uuid)
    {
        $this->stockOutRepository->approve($uuid);

        return redirect(route('administrator.inventory.stock-out'))->with('toast_success', 'Stock out has been approved.');
    }

    public function reject($uuid)
    {
        $this->stockOutRepository->reject($uuid);

        return redirect(route('administrator.inventory.stock-out'))->with('toast_success', 'Stock out has been rejected.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $stock = $this->stockOutRepository->getByUuid($uuid, ['body', 'body.product']);

        return view('administrators.pages.inventory.stock-out.show', compact('stock'));
    }
}
