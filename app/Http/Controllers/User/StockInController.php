<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StockInBodyStoreRequest;
use App\Http\Requests\User\StockInHeaderStoreRequest;
use App\Repositories\Interfaces\User\IStockInRepository;
use App\Repositories\Repository\Admin\ProductRepository;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    protected $repository;
    protected $productRepository;

    public function __construct(IStockInRepository $repository, ProductRepository $productRepository)
    {
        $this->repository = $repository;
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

        $stocks = $this->repository->paginated(10, ['type', 'status'], $searchQuery);

        $types = $this->repository->getStockInType();

        return view('users.pages.inventory.stock-in.index', compact('stocks', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = $this->repository->getStockInType();

        return view('users.pages.inventory.stock-in.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockInHeaderStoreRequest $request)
    {
        $stockIn = $this->repository->createOrderStockIn($request->validated());

        return redirect(route('users.inventories.stock-in.order', $stockIn->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $stock = $this->repository->getStockInDetail($uuid, ['type', 'status']);

        return view('users.pages.inventory.stock-in.show', compact('stock'));
    }

    public function order($uuid)
    {
        $stock = $this->repository->getStockInDetail($uuid, ['type', 'status', 'body', 'body.product']);
        $products = $this->productRepository->getAvailableProducts($stock->body->toArray(), 'stockInBody');

        if ($stock->status_id !== 1) {
            return redirect(route('users.inventories.stock-in'));
        }

        return view('users.pages.inventory.stock-in.order', compact('stock', 'products'));
    }

    public function storeOrder($uuid, StockInBodyStoreRequest $request)
    {
        $data = $this->repository->storeOrder($uuid, $request->validated());

        if (!$data) {
            return redirect(route('users.inventories.stock-in.order', $uuid))->with('toast_error', 'Jumlah melebihi kuantitas maksimal!')->withInput();
        }

        return redirect(route('users.inventories.stock-in.order', $uuid))->with('toast_success', 'Product added to Stock in list.');
    }

    public function submitOrder($uuid)
    {
        $this->repository->submitOrder($uuid);

        return redirect(route('users.inventories.stock-in'));
    }

    public function deleteBody($headerId, $bodyId)
    {
        $this->repository->deleteBody($bodyId);

        return redirect(route('users.inventories.stock-in.order', $headerId))->with('toast_success', 'Product removed from Stock in list.');
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
