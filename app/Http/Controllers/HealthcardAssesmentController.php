<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Assesment;
use App\Models\HealthCard;

class HealthcardAssesmentController extends Controller
{
    public function createAssesment(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'start' => 'required',
            'expiration' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $assesment = new Assesment();
        $assesment->name = $request->name;
        $assesment->start = $request->start;
        $assesment->expiration = $request->expiration;
        $assesment->save();
        $cardData = Assesment::all()->last();
        $healthCardData = new HealthCard();
        $healthCardData->animal=$request->id;
        $healthCardData->assesment=$cardData->id;
        $healthCardData->save();
        return redirect()->back()
            ->with("message","Operacja wykonana pomyślnie");
    }
    public function editAssesment(Request $request, $id){
        $validator = Validator::make($request->all(),[
                'name' => 'required|max:255',
                'start' => 'required|date_format:YYYY/mm/dd',
                'expiration' => 'required|date_format:YYYY/mm/dd',
        ]);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $assesment = Assesment::find($id);
        $assesment->name = $request->name;
        $assesment->start = $request->start;
        $assesment->expiration = $request->expiration;
        $assesment->save();return redirect()->back()
            ->with("message","Operacja wykonana pomyślnie");
    }
    public function deleteAssesment($id){
        HealthCard::where("assesment",$id)->delete();
        Assesment::where("id",$id)->delete();
    }
    public static function deleteAllAssesments($id){
        $cards = HealthCard::where("animal",$id);
        foreach($cards as $card){
            Assesment::where("id",$card->assesment)->delete();
        }
    }
}
