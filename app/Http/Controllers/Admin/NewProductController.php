<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewProductStoreRequest;
use App\Http\Requests\Admin\NewProductUpdateRequest;
use App\Repositories\Interfaces\Admin\INewProductRepository;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use Illuminate\Http\Request;

class NewProductController extends Controller
{
    protected $repository;
    protected $supplierRepository;

    public function __construct(INewProductRepository $repository, ISupplierRepository $supplierRepository)
    {
        $this->repository = $repository;
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

        $products = $this->repository->paginated(10, ['product', 'supplier'], $searchQuery);

        return view('administrators.pages.new-product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = $this->supplierRepository->getAll();

        return view('administrators.pages.new-product.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewProductStoreRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect(route('administrator.new-product'))->with('toast_success', 'Data up Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->repository->getById($id);
        $suppliers = $this->supplierRepository->getAll();
        
        return view('administrators.pages.new-product.edit', compact('suppliers', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewProductUpdateRequest $request, $id)
    {
        $this->repository->update($id, $request->validated());

        return redirect(route('administrator.new-product'))->with('toast_success', 'Data up Produk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);

        return redirect(route('administrator.new-product'))->with('toast_success', 'Data up Produk berhasil dihapus.');
    }
}
