<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShelterController;
use App\Models\Shelter;
use App\Models\User;

class AddressController extends Controller
{
    public function createUserAddress(Request $request){
        $validator = Validator::make($request->all(),[
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'region' => 'required|max:255',
            'street' => 'required|max:255',
            'local' => 'required|max:255|numeric',
            'postal' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $address = new Address();
        $address->country = $request->country;
        $address->city = $request->city;
        $address->region = $request->region;
        $address->street = $request->street;
        $address->local = $request->local;
        $address->postal = $request->postal;
        $address->save();
        $id = Address::all()->last();
        $user = Auth::user();
        $user->address = $id->id;
        $user->save();
        return (new HomeController)->index();
    }
    public static function createShelterAddress(Request $request, $sid){
        $address = new Address();
        $address->country = $request->country;
        $address->city = $request->city;
        $address->region = $request->region;
        $address->street = $request->street;
        $address->local = $request->local;
        $address->postal = $request->postal;
        $address->save();
        $id = Address::all()->last();
        $user = Shelter::find($sid);
        $user->address = $id->id;
        $user->save();
        return (new ShelterController)->index();
    }
    public static function deleteUserAddress($id){
        $user = User::find($id);
        $aid = $user->address;
        $user->address = null;
        $user->save();
        Address::find($aid)->delete();
        return redirect()->back()
            ->with("message","Operacja zakończona powodzeniem");
    }
    public function deleteShelterAddress($id){
        Address::find($id)->delete();
        return redirect()->back()
            ->with("message","Operacja zakończona powodzeniem");
    }
    public static function editAddress(Request $request){
        $validator = Validator::make($request->all(),[
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'region' => 'required|max:255',
            'street' => 'required|max:255',
            'local' => 'required|max:255|numeric',
            'postal' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $address = Address::find($request->id);
        $address->country = $request->country;
        $address->city = $request->city;
        $address->region = $request->region;
        $address->street = $request->street;
        $address->local = $request->local;
        $address->postal = $request->postal;
        $address->save();
        return redirect()->back()->with('message',"Operacja zakończona powodzeniem");
    }
    public function showAddressForm(){
        $user = Auth::user();
        $address = Address::find($user->address);
        return view("user-profile/forms/edit-address")->with("address",$address);
    }
}
