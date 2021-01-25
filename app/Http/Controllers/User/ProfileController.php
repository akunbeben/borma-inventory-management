<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordChangeRequest;
use App\Http\Requests\User\ProfileChangeRequest;
use App\Repositories\Interfaces\Admin\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = $this->userRepository->getByUuid(auth()->user()->id, ['image', 'division']);

        $fullName = explode(' ', $profile->name);

        return view('users.pages.profile.index', compact('profile', 'fullName'));
    }

    public function password(PasswordChangeRequest $request)
    {
        if (Hash::check($request->password, $this->userRepository->getByUuid(auth()->user()->id, null, true)->password)) {
            $this->userRepository->changePassword($request->validated()['new-password'], auth()->user()->id);
            
            return redirect(route('users.profile'))->with('toast_success', 'Password berhasil diubah.');
        }

        return redirect(route('users.profile'))->withInput()->withErrors(['password' => [trans('validation.password')]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
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
    public function update(ProfileChangeRequest $request)
    {
        $this->userRepository->changeProfile($request->validated(), auth()->user()->id);

        return redirect(route('users.profile'))->with('toast_success', 'Profil berhasil diupdate.');
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
