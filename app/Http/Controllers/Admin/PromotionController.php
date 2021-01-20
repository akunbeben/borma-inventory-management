<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromotionStoreRequest;
use App\Http\Requests\Admin\PromotionUpdateRequest;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\Admin\IPromotionRepository;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $promotionRepository;
    protected $productRepository;

    public function __construct(IPromotionRepository $promotionRepository, IProductRepository $productRepository)
    {
        $this->promotionRepository = $promotionRepository;
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

        if($request->has('search')) $searchQuery = $request->search;

        $data = $this->promotionRepository->paginated(10, null, $searchQuery);

        return view('administrators.pages.promotions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->getAll();
        return view('administrators.pages.promotions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionStoreRequest $request)
    {
        $this->promotionRepository->save($request->validated());
        
        return redirect(route('administrator.promotions.list'))->with('toast_success', 'New promotion has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return view('administrators.pages.promotions.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $products = $this->productRepository->getAll();
        $promo = $this->promotionRepository->getByUuid($uuid, null);

        return view('administrators.pages.promotions.edit', compact('products', 'promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionUpdateRequest $request, $uuid)
    {
        $this->promotionRepository->updates($uuid, $request->validated());

        return redirect(route('administrator.promotions.list'))->with('toast_success', 'Promotion has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->promotionRepository->delete($uuid);

        return redirect(route('administrator.promotions.list'))->with('toast_success', 'Promotion has been deleted.');
    }
}
