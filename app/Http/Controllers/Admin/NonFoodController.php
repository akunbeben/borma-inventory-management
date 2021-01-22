<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NonFoodStoreRequest;
use App\Http\Requests\Admin\NonFoodUpdateRequest;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use Illuminate\Http\Request;

class NonFoodController extends Controller
{
    protected $productRepository;
    protected $supplierRepository;
    protected int $type = 2;

    public function __construct(IProductRepository $productRepository, ISupplierRepository $supplierRepository)
    {
        $this->productRepository = $productRepository;
        $this->supplierRepository = $supplierRepository;
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

        $products = $this->productRepository->paginated(10, null, $searchQuery, $this->type);

        return view('administrators.pages.products.non-food.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = $this->supplierRepository->getAll();

        return view('administrators.pages.products.non-food.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NonFoodStoreRequest $request)
    {
        $this->productRepository->save($request->validated(), $this->type);
        
        return redirect(route('administrator.products.non-food.list'))->with('toast_success', 'Data barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $product = $this->productRepository->getByUuid($uuid, ['supplier', 'inventory'], $this->type);

        return view('administrators.pages.products.non-food.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $suppliers = $this->supplierRepository->getAll();
        $product = $this->productRepository->getByUuid($uuid, ['supplier'], $this->type);
        
        return view('administrators.pages.products.non-food.edit', compact('suppliers', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(NonFoodUpdateRequest $request, $uuid)
    {
        $this->productRepository->updates($request->validated(), $uuid, $this->type);
        
        return redirect(route('administrator.products.non-food.show', $uuid))->with('toast_success', 'Barang berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->productRepository->delete($uuid, $this->type);

        return redirect(route('administrator.products.food.list'))->with('toast_success', 'Barang berhasil dihapus.');
    }
}
