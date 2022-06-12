<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\File;
use App\Models\Address;
use App\Models\Shelter;
use App\Models\User;

class ShelterController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function showShelterList(){
        $shelters = Shelter::all();
        $addresses = Address::all();
        if(Auth::user()!=null){
            if(Auth::user()->role==1){
                return view('admin-panel/shelters-list')->with("shelters",$shelters)->with("addresses",$addresses);
            }else{redirect()->back();}
        }else{ redirect()->back();}
    }
    public function showShelterForm(){
        $shelters = Shelter::all();
        $addresses = Address::all();
        if(Auth::user()!=null){
            if(Auth::user()->role==1){
                return view('admin-panel/forms/create-shelter');
            }else{redirect()->back();}
        }else{ redirect()->back();}
    }
    public function showEditShelterForm($id){
        $shelter = Shelter::find($id);
        $address = Address::find($shelter->address);
        return view('admin-panel/forms/edit-shelter')->with("shelter",$shelter)->with("address",$address);
    }
    public function createShelter(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'NIP' => 'required|max:255',
            'mail' => 'required|max:255|email|unique:Shelter,mail',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'region' => 'required|max:255',
            'street' => 'required|max:255',
            'local' => 'required|max:255|numeric',
            'postal' => 'required|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $shelter = new Shelter();
        $shelter->name = $request->name;
        $shelter->phone = $request->phone;
        $shelter->NIP = $request->NIP;
        $shelter->mail = $request->mail;
        $shelter->save();
        $aid = Shelter::All()->last();
        $filename = 's'.$aid->id.'.png';
        $request->file('image')->move(public_path('images'), $filename);
        AddressController::createShelterAddress($request,$aid->id);
        return redirect()->back()
        ->with("message","Operacja zakończona powodzeniem");
    }
    public function editShelterInformation(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'NIP' => 'required|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'region' => 'required|max:255',
            'street' => 'required|max:255',
            'local' => 'required|max:255|numeric',
            'postal' => 'required|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $shelter = Shelter::find($request->sid);
        if($request->mail!=$shelter->mail){
            $validatorMail = Validator::make($request->all,[
                'mail' => 'required|max:255|email|unique:Shelter,mail'
            ]);
            if($validatorMail->fails()){
                return redirect()->back()
                ->withErrors($validatorMail)
                ->withInput();
            }
            $shelter->mail = $request->mail;
        }
        $shelter->name = $request->name;
        $shelter->phone = $request->phone;
        $shelter->NIP = $request->NIP;
        $shelter->save();
        if($request->hasFile('image')){
            $aid = $request->sid;
            $filename = 's'.$aid.'.png';
            unlink(public_path('images').'/'.$filename);
            $request->file('image')->move(public_path('images'), $filename);
        }
        AddressController::editAddress($request);
        return redirect()->back()
        ->with("message","Operacja zakończona powodzeniem");
    }
    public function deleteShelter($id){
        $filename='s'.$id.'.png';
        unlink(public_path('images').'/'.$filename);
        $shelter = Shelter::find($id)->delete();
        return redirect()->back()
            ->with("message","Operacja powiodła się sukcesem");
    }
    public function assignShelter($id,$uid){
        $user = User::find($uid);
        $user->shelter=$id;
        $user->save();
        return redirect()->back()
            ->with("message","Operacja powiodła się sukcesem");
    }
    public function revokeShelter($uid){
        $user = User::find($uid);
        $user->shelter=null;
        $user->save();
        return redirect()->back()
            ->with("message","Operacja powiodła się sukcesem");
    }
    public function showShelterProfile($id=-1){
        $shelter=null;
        if($id==-1){
            $shelter = Shelter::find(Auth::user()->shelter);
        }else{
            $shelter = Shelter::find($id);
        }
        $address = Address::find($shelter->address);
        return view('shelter-panel/shelter-data')->with("shelter",$shelter)->with("address",$address);
    }
}
