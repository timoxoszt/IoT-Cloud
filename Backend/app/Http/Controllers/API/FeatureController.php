<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Feature;
use App\Http\Resources\Feature as FeatureResource;

class FeatureController extends BaseController
{    
    public function store(Request $request)
    {
        $authUser = Auth::user();
        $input = $request->all();
        $validator = Validator::make($input, [
            'device' => 'required',
            'value' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $feature = Feature::create([
            'user_id' => $authUser->id,
            'device' => $request->device,
            'value' => $request->value,
            'type' => $request->type,
            'note' => $request->note,
        ]);
        return $this->sendResponse(new FeatureResource($feature), 'Feature created.');
    }   
    
    public function update(Request $request, $uuid)
    {
        $authUser = Auth::user();
        $feature = Feature::where('uuid', $uuid)->first();

        $input = $request->all();
        $validator = Validator::make($input, [
            'device' => 'required',
            'value' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        try{
            $feature->device = $input['device'];
            $feature->value = $input['value'];
            $feature->type = $input['type'];
            $feature->note = $input['note'];
            $feature->save();
        }catch(\Exception $e){
            return $this->sendError('Permission denied.');
        }
        
        
        return $this->sendResponse(new FeatureResource($feature), 'Feature updated.');
    }
}
