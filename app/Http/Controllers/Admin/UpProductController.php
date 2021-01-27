<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpProductStoreRequest;
use App\Http\Requests\Admin\UpProductUpdateRequest;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\Admin\IUpProductRepository;
use Illuminate\Http\Request;

class UpProductController extends Controller
{
    protected $repository;
    protected $productRepository;

    public function __construct(IUpProductRepository $repository, IProductRepository $productRepository)
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

        $products = $this->repository->paginated(10, ['product'], $searchQuery);

        return view('administrators.pages.up-product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->getAll();

        return view('administrators.pages.up-product.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpProductStoreRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect(route('administrator.up-product'))->with('toast_success', 'Data up Produk berhasil ditambahkan');
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
        $products = $this->productRepository->getAll();
        
        return view('administrators.pages.up-product.edit', compact('products', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpProductUpdateRequest $request, $id)
    {
        $this->repository->update($id, $request->validated());

        return redirect(route('administrator.up-product'))->with('toast_success', 'Data up Produk berhasil diupdate.');
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

        return redirect(route('administrator.up-product'))->with('toast_success', 'Data up Produk berhasil dihapus.');
    }
}
