<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Admin\IUpProductRepository;
use Illuminate\Http\Request;

class UpProductController extends Controller
{
    protected $repository;

    public function __construct(IUpProductRepository $repository)
    {
        $this->repository = $repository;
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

        return view('users.pages.up-product.index', compact('products'));
    }
}
