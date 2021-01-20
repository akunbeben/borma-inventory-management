<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StockOutBodyStoreRequest;
use App\Http\Requests\User\StockOutHeaderStoreRequest;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\User\IStockOutRepository;
use Illuminate\Http\Request;
use Psy\CodeCleaner\AssignThisVariablePass;

class StockOutController extends Controller
{
    protected $stockOutRepository;
    protected $productRepository;

    public function __construct(IStockOutRepository $stockOutRepository, IProductRepository $productRepository)
    {
        $this->stockOutRepository = $stockOutRepository;
        $this->productRepository = $productRepository;
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

        $stocks = $this->stockOutRepository->paginated(10, null, $searchQuery);
        $types = $this->stockOutRepository->getStockOutType();

        return view('users.pages.inventory.stock-out.index', compact('stocks', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StockOutHeaderStoreRequest $request)
    {
        $stockOut = $this->stockOutRepository->create($request->validated());

        return redirect(route('users.inventories.stock-out.order', $stockOut->id));
    }

    public function order($uuid)
    {
        $stock = $this->stockOutRepository->getByUuid($uuid, ['type', 'body.product']);
        $products = $this->productRepository->getAvailableProducts($stock->body->toArray(), 'stockOutBody');

        if ($stock->status_id !== 1) return redirect(route('users.inventories.stock-out'));

        return view('users.pages.inventory.stock-out.order', compact('stock', 'products'));
    }

    public function submit($uuid)
    {
        $this->stockOutRepository->submit($uuid);

        return redirect(route('users.inventories.stock-out'));
    }

    public function storeChild($uuid, StockOutBodyStoreRequest $request)
    {        
        $data = $this->stockOutRepository->appendChild($uuid, $request->validated());

        if ($data == null) {
            return redirect(route('users.inventories.stock-out.order', $uuid))->with('toast_error', 'Quantity amount is over the stock, please check it.')->withInput();
        }

        return redirect(route('users.inventories.stock-out.order', $uuid))->with('toast_success', 'Product added to Stock out list.');
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
        $stock = $this->stockOutRepository->getByUuid($uuid, null);

        return view('users.pages.inventory.stock-out.show', compact('stock'));
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
    public function destroy($parentId, $childId)
    {
        $this->stockOutRepository->removeChild($childId);

        return redirect(route('users.inventories.stock-out.order', $parentId))->with('toast_success', 'Product removed from Stock out list.');
    }
}
