<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Repositories\Interfaces\Admin\IDivisionRepository;
use App\Repositories\Interfaces\Admin\IUserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $divisionRepository;

    public function __construct(IUserRepository $userRepository, IDivisionRepository $divisionRepository)
    {
        $this->userRepository = $userRepository;
        $this->divisionRepository = $divisionRepository;
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

        $users = $this->userRepository->paginated(10, ['division'], $searchQuery); 

        return view('administrators.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = $this->divisionRepository->getAll();
        return view('administrators.pages.users.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->userRepository->save($request->validated());

        return redirect(route('administrator.users.list'))->with('toast_success', 'Data user berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $user = $this->userRepository->getByUuid($uuid, ['division']);

        return view('administrators.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $user = $this->userRepository->getByUuid($uuid, null);
        $divisions = $this->divisionRepository->getAll();

        return view('administrators.pages.users.edit', compact('user', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $uuid)
    {
        $this->userRepository->updates($uuid, $request->validated());

        return redirect(route('administrator.users.show', $uuid))->with('toast_success', 'Data user berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->userRepository->delete($uuid);

        return redirect(route('administrator.users.list'))->with('toast_success', 'Data user berhasil dihapus.');
    }
    
    public function resetPassword($uuid)
    {
        $this->userRepository->passwordReset($uuid);
        
        return redirect(route('administrator.users.show', $uuid))->with('toast_success', 'Password user dikembalikan ke password bawaan.');
    }
}
