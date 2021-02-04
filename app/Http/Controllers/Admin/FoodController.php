<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FoodStoreRequest;
use App\Http\Requests\Admin\FoodUpdateRequest;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected $productRepository;
    protected $supplierRepository;
    protected $user;
    protected const TYPE = 1;

    public function __construct(IProductRepository $productRepository, ISupplierRepository $supplierRepository)
    {
        $this->productRepository = $productRepository;
        $this->supplierRepository = $supplierRepository;
        $this->administrator = auth('administrator-web');
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

        $products = $this->productRepository->paginated(10, null, $searchQuery, self::TYPE);

        return view('administrators.pages.products.food.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = $this->supplierRepository->getAll();

        return view('administrators.pages.products.food.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodStoreRequest $request)
    {
        $this->productRepository->save($request->validated(), self::TYPE, $this->administrator->user()->id);
        
        return redirect(route('administrator.products.food.list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $product = $this->productRepository->getByUuid($uuid, ['supplier', 'inventory'], self::TYPE);

        return view('administrators.pages.products.food.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $suppliers = $this->supplierRepository->getAll();
        $product = $this->productRepository->getByUuid($uuid, ['supplier'], self::TYPE);
        
        return view('administrators.pages.products.food.edit', compact('suppliers', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodUpdateRequest $request, $uuid)
    {
        $this->productRepository->updates($request->validated(), $uuid, self::TYPE);
        
        return redirect(route('administrator.products.food.show', $uuid))->with('toast_success', 'Barang berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->productRepository->delete($uuid, self::TYPE);

        return redirect(route('administrator.products.food.list'))->with('toast_success', 'Barang berhasil dihapus.');
    }
}
