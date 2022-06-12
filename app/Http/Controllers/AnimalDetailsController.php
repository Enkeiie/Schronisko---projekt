<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Attribute;
use App\Models\AnimalInfo;

class AnimalDetailsController extends Controller
{
    public function addAnimalDetail(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $details = new Attribute();
        $details->name = $request->name;
        $details->value = $request->value;
        $details->save();
        $detailData = Attribute::all()->last();
        $detailInfo = new AnimalInfo();
        $detailInfo->animal = $request->id;
        $detailInfo->attribute = $detailData->id;
        $detailInfo->save();
        return redirect()->back()
            ->with("message","Operacja wykonana pomyślnie");

    }
    public function editAnimalDetail(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $details = new Attribute();
        $details->name = $request->name;
        $details->value = $request->value;
        $details->save();
        $detailData = Attribute::all()->last();
        $detailInfo = AnimalInfo::find($id);
        $detailInfo->animal = $request->id;
        $detailInfo->attribute = $detailData->id;
        $detailInfo->save();
        return redirect()->back()
            ->with("message","Operacja wykonana pomyślnie");
    }
    public function deleteAnimalDetail($id){
        AnimalInfo::where("attribute",$id)->delete();
        Attribute::find($id)->delete();
    }
    public static function deleteAllDetails($id){
        $animals = AnimalInfo::where("animal",$id);
        foreach ($animals as $animal) {
            Attribute::find($animal->attribute)->delete();
        }
        $animals->delete();
    }
}
