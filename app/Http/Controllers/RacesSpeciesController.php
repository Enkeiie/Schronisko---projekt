<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Race;
use App\Models\Specie;

class RacesSpeciesController extends Controller
{
    public function createSpecie(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $specie = new Specie();
        $specie->name=$request->name;
        $specie->save();
        return redirect()->back()
            ->with("message","Pomyślnie dodano gatunek");
   }
    public function editSpecie(Request $request, $id){
       $validator = Validator::make($request->all(),[
           'name' => 'required|max:255',
       ]);
       if($validator->fails()){
           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
       }
        $specie = Specie::find($id);
        $specie->name=$request->name;
        $specie->save();
       return redirect()->back()
           ->with("message","Pomyślnie edytowano gatunek");
   }
    public function deleteSpecie($id){
        Race::where('species', $id)->delete();
        Specie::find($id)->delete();
        return redirect()->back()
            ->with("message","Pomyślnie wykonano operację");
    }
    public function createRace(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'species' => 'required|numeric',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $race = new Race();
        $race->name=$request->name;
        $race->species=$request->species;
        $race->save();
        return redirect()->back()
            ->with("message","Pomyślnie dodano rasę");
    }
    public function editRace(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'species' => 'required|numeric',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $race = Race::find($id);
        $race->name=$request->name;
        $race->species=$request->species;
        $race->save();
        return redirect()->back()
            ->with("message","Pomyślnie edytowano rasę");
    }
    public function deleteRace($id){
        Race::find($id)->delete();
        return redirect()->back()
            ->with("message","Pomyślnie wykonano operację");
    }
    public function showRacesList(){
        $species = Specie::all();
        $races = Race::all();
        if(Auth::user()!=null){
            if(Auth::user()->role==1){
                return view('admin-panel/races-list')->with("species",$species)->with("races",$races);
            }else{redirect()->back();}
        }else{ redirect()->back();}
    }
    public function showEditRaceForm($id){
        $species = Specie::all();
        $race = Race::find($id);
        return view('admin-panel/forms/edit-race')->with("species",$species)->with("race",$race);
    }
    public function showEditSpecieForm($id){
        $species = Specie::find($id);
        return view('admin-panel/forms/edit-specie')->with("specie",$species);
    }
}
