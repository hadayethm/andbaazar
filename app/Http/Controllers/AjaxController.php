<?php

namespace App\Http\Controllers;
use App\Models\Geo\Division;
use App\Models\Geo\District;
use App\Models\Geo\Upazila;
use App\Models\Geo\Municipal;
use App\Models\Geo\Union;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getDistrict(Request $request){
        // echo $request->division;
        $division = Division::with('district')->find($request->division);
        $options = '<option value="" selected disabled>Select District</option>';

        foreach($division->district as $row){
            $options .= "<option value='{$row->id}' data-lat='{$row->lat}' data-lng='{$row->lng}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>District not found</option>';
        }
        echo $options;
    }

    public function getUpazila(Request $request){
        $district = District::with('upazila','municipal')->find($request->district);
        $options = '<option value="" selected disabled>Select Upazila</option>';
        $municipals = '<option value="" selected disabled>Select municipal</option>';

        foreach($district->municipal as $row){
            $municipals .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($municipals)){
            $municipals .= '<option value="" selected disabled>Municipal not found</option>';
        }

        foreach($district->upazila as $row){
            $options .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Upazila not found</option>';
        }
        echo json_encode(['upazila' => $options,'municipal' => $municipals]);
    }

    public function getUnion(Request $request){
        $upazila = Upazila::with('union')->find($request->upazila);
        $options = '<option value="" selected disabled>Select Union</option>';
        foreach($upazila->union as $row){
            $options .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Union not found</option>';
        }
        echo $options;
    }

    public function getVillage(Request $request){
        $unions = Union::with('village')->find($request->union);
        $options = '<option value="" selected disabled>Select Village</option>';
        foreach($unions->village as $row){
            $options .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Village not found</option>';
        }
        echo $options;
    }

    public function getWard(Request $request){
        $municipal = Municipal::with('wards')->find($request->municipal);
        $options = '<option value="" selected disabled>Select ward</option>';
        foreach($municipal->wards as $row){
            $options .= "<option value='{$row->id}'>{$row->name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Ward not found</option>';
        }
        echo $options;
    }
}
