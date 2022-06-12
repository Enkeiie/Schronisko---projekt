<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AnimalDetailsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Animal;
use App\Models\Shelter;
use App\Models\User;
use App\Models\Address;
use App\Models\Specie;
use App\Models\Race;
use App\Models\Attribute;
use App\Models\AnimalInfo;
use App\Models\HealthCard;
use App\Models\Assesment;

class AnimalController extends Controller
{
    public function createAnimal(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:250',
            'race' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|max:250',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $animal = new Animal();
        $animal->name = $request->name;
        $animal->race = $request->race;
        $animal->age = $request->age;
        $animal->gender = $request->gender;
        if(Auth::user()->shelter==null){
            $animal->user = Auth::user()->id;
        }else{
            $animal->shelter = Auth::user()->shelter;
        }
        $animal->save();
        $aid = Animal::All()->last();
        $filename = 'a'.$aid->id.'.png';
        $request->file('image')->move(public_path('images'), $filename);
        return redirect()->back()
            ->with("message","Pomyślnie dodano zwierzę");
    }
    public function editAnimal(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:250',
            'race' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|max:250',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $animal = Animal::find($request->id);
        $animal->name = $request->name;
        $animal->race = $request->race;
        $animal->age = $request->age;
        $animal->gender = $request->gender;
        if(Auth::user()->shelter==null){
            $animal->user = Auth::user()->id;
        }else{
            $animal->shelter = Auth::user()->shelter;
        }
        $animal->save();
        if($request->hasFile('image')){
            $aid = $request->id;
            $filename = 'a'.$aid.'.png';
            unlink(public_path('images').'/'.$filename);
            $request->file('image')->move(public_path('images'), $filename);
        }
        return redirect()->back()
            ->with("message","Pomyślnie edytowano zwierzę");
    }
    public function deleteAnimal($id){
        AnimalDetailsController::deleteAllDetails($id);
        HealthcardAssesmentController::deleteAllAssesments($id);
        $filename='a'.$id.'.png';
        unlink(public_path('images').'/'.$filename);
        Animal::find($id)->delete();
        return redirect()->back()->with("message","Operacja wykonana poprawnie!");
    }
    public function showAnimalBrowser(){
        $shelters = Shelter::all();
        $addresses = Address::all();
        $users = User::all();
        $animals = Animal::all();
        $races = Race::all();
        $species = Specie::all();
        return view('animal-panel/animal-browser')->with("users",$users)->with("shelters",$shelters)->with("addresses",$addresses)->with("animals",$animals)->with("races",$races)->with("species",$species);
    }
    public function showAnimalList(){
        $shelters = Shelter::all();
        $addresses = Address::all();
        $users = User::all();
        $animals = Animal::all();
        $races = Race::all();
        $species = Specie::all();
        return view('animal-panel/animal-list')->with("users",$users)->with("shelters",$shelters)->with("addresses",$addresses)->with("animals",$animals)->with("races",$races)->with("species",$species);
    }
    public function showMyAnimalList(){
        $shelters = Shelter::all();
        $addresses = Address::all();
        $users = User::all();
        $animals = Animal::where("user",Auth::user()->id)->orWhere("shelter",Auth::user()->shelter)->get();
        $races = Race::all();
        $species = Specie::all();
        return view('animal-panel/animal-list')->with("users",$users)->with("shelters",$shelters)->with("addresses",$addresses)->with("animals",$animals)->with("races",$races)->with("species",$species);
    }
    public function showAnimalForm(){
        $races = Race::all();
        $species = Specie::all();
        return view('animal-panel/forms/create-animal')->with("species",$species)->with("races",$races);
    }
    public function showEditAnimalForm($id){
        $animal = Animal::find($id);
        $races = Race::all();
        $species = Specie::all();
        return view('animal-panel/forms/edit-animal')->with("species",$species)->with("races",$races)->with("animal",$animal);
    }
    public function showAnimalProfile($id){
        $healthcards = HealthCard::all();
        $assesments = Assesment::all();
        $animaldetails = AnimalInfo::all();
        $attributes = Attribute::all();
        $addresses = Address::all();
        $animals = Animal::find($id);
        $users = User::find($animals->user);
        $shelters = Shelter::find($animals->shelter);
        $races = Race::all();
        $species = Specie::all();
        return view('animal-panel/animal-profile')->with("user",$users)->with("shelter",$shelters)->with("address",$addresses)
        ->with("animal",$animals)->with("races",$races)->with("species",$species)->with("assesments",$assesments)
        ->with("healthcards",$healthcards)->with("animaldetails",$animaldetails)->with("attributes",$attributes);
    }
}
