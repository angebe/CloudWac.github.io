<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Repositories\UserRepository;
use Illuminate\Auth\Guard;

class UserController extends Controller
{

    protected $UserRepository;

    protected $nbrPerPage = 7;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->UserRepository->getPaginate($this->nbrPerPage);
        $links = str_replace('/?', '?', $users->render());
        return view('admin.admin', compact('users', 'links'));
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return view('user.show',  compact('user'));
    }

    public function edit($id)
    {
        if(\Auth::id() == $id) {
        // $user = User::find(Auth::user()->id);
        $user = $this->userRepository->getById($id);

        return view('user.edit',  compact('user'), array('id' => $user));
        }
        return redirect()->back();
    }

    public function update(UserUpdateRequest $request, $id)
    {
        if(\Auth::id()  == $id){
        $this->userRepository->update($id, $request->all());
        
        return redirect('user')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        if(\Auth::id()  == $id){
        $this->userRepository->destroy($id);

        return redirect()->back();
        }
        return redirect()->back();
    }
}