<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function setUserRole($uid,$role){
        $user = User::find($uid);
        $user->role=$role;
        $user->save();
        return redirect()->back()
            ->with("message","Operacja zakończona sukcesem");
    }
    public function editUserData(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'email' => 'required|max:255|email',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($request->id);
        if($request->email != $user->email) {
            $validatoremail = Validator::make([$request->email], [
                'email' => 'max:255|email|unique:User,email',
            ]);
            if ($validatoremail->fails()) {
                return redirect()->back()
                    ->withErrors($validatoremail)
                    ->withInput();
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password!=$user->password) {
            $user->password = bcrypt($request['password']);
        }
        $user->save();
        return redirect()->back()
            ->with("message","Poprawnie zaktualizowano dane");
    }
    public function deleteUser($id){
        $chk = User::find($id);
        if($chk->address!=null){
        AddressController::deleteUserAddress($id);
        }
        User::find($id)->delete();
        return redirect()->back()
            ->with("message","Operacja zakończona sukcesem");
    }
    public function showUserProfile(){
        $user = Auth::user();
        $address = Address::find($user->address);
        return view('user-profile/profile-data')->with("user",$user)->with("address",$address);
    }
    public function showUserForm(){
        $user = Auth::user();
        return view("user-profile/forms/edit-data")->with("user",$user)->with("message",null);
    }
    public function showEditUserForm($id){
        $editedUser=User::find($id);
        $user = Auth::user();
        if($user!=null){
            if($user->role==1){
            return view("admin-panel/forms/edit-user")->with("user",$editedUser);
            }else{redirect()->back();}
        }else{ redirect()->back();}
    }
    public function showUserList(){
        $users=User::all();
        $user = Auth::user();
        if($user!=null){
            if($user->role==1){
            return view("admin-panel/user-list")->with("users",$users);
            }else{redirect()->back();}
        }else{ redirect()->back();}
    }
    public function showAdminPanel(){
        if(Auth::user()->role==1){
            return view("admin-panel/index");
        }else{redirect()->back();}
    }
}
