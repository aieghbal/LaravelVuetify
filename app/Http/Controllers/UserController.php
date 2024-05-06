<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('perPage') == -1){
            $data = User::paginate(1000);
        }else{
            $data = User::paginate($request->get('perPage'));
        }
        if ($request->get('search')){
            $data = User::where('name', 'like', $request->get('search').'%')->paginate(10);
        }
        return response()->json($data);
    }

    public function editItem(Request $request)
    {
        $user = User::find($request->post('id'));
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->save();
    }

    public function deleteItem(Request $request)
    {
        $user = User::find($request->post('id'));
        $user->delete();
    }

    public function addItem(Request $request){
        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = 123456;
        $user->save();
    }
}
