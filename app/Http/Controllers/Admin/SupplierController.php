<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SupplierStoreRequest;
use App\Http\Requests\Admin\SupplierUpdateRequest;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(ISupplierRepository $supplierRepository)
    {
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

        $suppliers = $this->supplierRepository->paginated(10, null, $searchQuery);

        return view('administrators.pages.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrators.pages.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierStoreRequest $request)
    {
        $this->supplierRepository->save($request->validated(), auth()->user()->id);

        return redirect(route('administrator.suppliers.list'))->with('toast_success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $supplier = $this->supplierRepository->getByUuid($uuid, null);
        
        return view('administrators.pages.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $supplier = $this->supplierRepository->getByUuid($uuid, null);

        return view('administrators.pages.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, $uuid)
    {
        $this->supplierRepository->updates($uuid, $request->validated());
        
        return redirect(route('administrator.suppliers.show', $uuid))->with('toast_success', 'Data supplier berhasil diubah.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->supplierRepository->delete($uuid);

        return redirect(route('administrator.suppliers.list'))->with('toast_success', 'Data supplier berhasil dihapus.');
    }
}
