<?php

namespace App\Http\Controllers\Api\Customer;
use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
// use App\User;
use App\Http\Resources\Customer\AddressCollection;
use App\Http\Resources\Customer\AddressResource;
use App\Http\Resources\PlaceOrder\DistrictCollection;
use App\Http\Resources\PlaceOrder\UpazilaCollection;
use App\Http\Traits\apiTrait;
use App\Models\Geo\District;
use App\Models\Geo\Union;
use App\Models\Geo\Upazila;
use App\Models\Geo\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerAddressController extends Controller{
    use apiTrait;
    public function index(Request $request){
        $user = $request->user();
        $address = CustomerAddress::where('user_id',$user->id)->get();
        return $this->jsonResponse(new AddressCollection($address),'success',false);
    }

    public function createAddress(Request $request,CustomerAddress $address){
        $validator = Validator::make($request->all(),[
            'division_id'           => 'required',
            'district_id'           => 'required',
            'zip_code'              => 'required',
            'address'               => 'required',
            'name'                  => 'required',
            'phone'                 => 'required',
            'address_type'          => 'required',
            'is_default_shipping'   => 'required',
            'is_default_billing'    => 'required',
        ]);
        if($validator->fails()){
            return $this->jsonResponse([],$validator->getMessageBag()->first());
        }
        $user = $request->user();
        
        if($request->is_default_shipping === 1){
            CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
        }
        if($request->is_default_billing === 1){
            CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
        }
        $data = [
            'division_id'         => $request->division_id,
            'district_id'         => $request->district_id,
            'zip_code'            => $request->zip_code,
            'address'             => $request->address,
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type,
            'is_default_shipping' => $request->is_default_shipping,
            'is_default_billing'  => $request->is_default_billing,
            'user_id'             => $user->id,
        ];
        $address = CustomerAddress::create($data);
        return $this->jsonResponse(new AddressResource($address),'success',false);
    }

    public function updateAddress(Request $request,$id){
        $validator = Validator::make($request->all(),[
            // 'id'                    => 'required',
            'division_id'           => 'required',
            'district_id'           => 'required',
            'zip_code'              => 'required',
            'address'               => 'required',
            'name'                  => 'required',
            'phone'                 => 'required',
            'address_type'          => 'required',
            'is_default_shipping'   => 'required',
            'is_default_billing'    => 'required',
        ]);
        if($validator->fails()){
            return $this->jsonResponse([],$validator->getMessageBag()->first());
        }
        $user = $request->user();
        
        if($request->is_default_shipping === 1){
            CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
        }
        if($request->is_default_billing === 1){
            CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
        }
        $data = [
            'division_id'         => $request->division_id,
            'district_id'         => $request->district_id,
            'zip_code'            => $request->zip_code,
            'address'             => $request->address,
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type,
            'is_default_shipping' => $request->is_default_shipping,
            'is_default_billing'  => $request->is_default_billing,
            'user_id'             => $user->id,
        ];
        // dd($data);
        $address = CustomerAddress::where('user_id',$user->id)->where('id',$id)->first();
        $address->update($data);
        return $this->jsonResponse(new AddressResource($address->refresh()),'success',false);
    }

    public function delete(Request $request,$id){
        // $validator = Validator::make($request->all(),[
        //     'id'           => 'required',
        // ]);
        // if($validator->fails()){
        //     return $this->jsonResponse([],$validator->getMessageBag()->first());
        // }
        $user = $request->user();
        $address = CustomerAddress::where('user_id',$user->id)->where('id',$id)->delete();
        if($address){
            return $this->jsonResponse([],'Address deleted success',false);
        }
        return $this->jsonResponse([],'Address not deleted');
    }

    //Billing address
    public function bllingAddress(Request $request){
        $userId = auth()->user()->id; 
      
            $validator = Validator::make($request->all(),[
                'division_id'           => 'required',
                'district_id'           => 'required',
                'zip_code'              => 'required',
                'address'               => 'required',
                'name'                  => 'required',
                'phone'                 => 'required',
                'address_type'          => 'required',
                'is_default_shipping'   => 'required',
                'is_default_billing'    => 'required',
            ]);
            if($validator->fails()){
                return $this->jsonResponse([],$validator->getMessageBag()->first());
            }
            // $user = $request->user();
            
            // if($request->is_default_shipping === 1){
            //     CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
            // }
            // if($request->is_default_billing === 1){
            //     CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
            // }
            $data = [
                'division_id'         => $request->division_id,
                'district_id'         => $request->district_id,
                'upazila_id'          => $request->upazila_id,
                'union_id'            => $request->union_id,
                'zip_code'            => $request->zip_code,
                'address'             => $request->address,
                'name'                => $request->name,
                'phone'               => $request->phone,
                'address_type'        => $request->address_type, 
                'is_default_shipping' => $request->is_default_shipping,
                'is_default_billing'  => $request->is_default_billing,
                'user_id'             => $userId,
            ];
            $address = CustomerAddress::create($data);
            return $this->jsonResponse(new AddressResource($address),'Billing Address create successfully',false);
        
    }

    public function updateBllingAddress(Request $request,$id){
        $userId = auth()->user()->id;
        $address = CustomerAddress::where('user_id',$userId)->where('is_default_billing',1)->where('id',$id)->first();
       
        $validator = Validator::make($request->all(),[ 
            'division_id'           => 'required',
            'district_id'           => 'required',
            'zip_code'              => 'required',
            'address'               => 'required',
            'name'                  => 'required',
            'phone'                 => 'required',
            'address_type'          => 'required', 
            'is_default_billing'    => 'required',
        ]);
        if($validator->fails()){
            return $this->jsonResponse([],$validator->getMessageBag()->first());
        }
       
        
        // if($request->is_default_shipping === 1){
        //     CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
        // }
        // if($request->is_default_billing === 1){
        //     CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
        // }
        $data = [
            'division_id'         => $request->division_id,
            'district_id'         => $request->district_id,
            'upazila_id'          => $request->upazila_id,
            'union_id'            => $request->union_id,
            'zip_code'            => $request->zip_code,
            'address'             => $request->address,
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type, 
            'is_default_billing'  => $request->is_default_billing,
            'user_id'             => $userId,
        ];
        
        $address->update($data);
        return $this->jsonResponse(new AddressResource($address->refresh()),'Billing Address updated successfully',false);
    }

    public function deleteBillingAddress($id){
        $address = CustomerAddress::findOrfail($id);
        $address->delete();

        return $this->jsonResponse([],'Billing Address deleted successfully',false);
    }

    //Shipping Address
    public function shippingAddress(Request $request){
        $userId = auth()->user()->id; 
            $validator = Validator::make($request->all(),[
                'division_id'           => 'required',
                'district_id'           => 'required',
                'zip_code'              => 'required',
                'address'               => 'required',
                'name'                  => 'required',
                'phone'                 => 'required',
                'address_type'          => 'required',
                'is_default_shipping'   => 'required',
                'is_default_billing'    => 'required',
            ]);
            if($validator->fails()){
                return $this->jsonResponse([],$validator->getMessageBag()->first());
            }
           
            // if($request->is_default_shipping === 1){
            //     CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
            // }
            // if($request->is_default_billing === 1){
            //     CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
            // }
            $data = [
                'division_id'         => $request->division_id,
                'district_id'         => $request->district_id,
                'upazila_id'          => $request->upazila_id,
                'union_id'            => $request->union_id,
                'zip_code'            => $request->zip_code,
                'address'             => $request->address,
                'name'                => $request->name,
                'phone'               => $request->phone,
                'address_type'        => $request->address_type, 
                'is_default_shipping' => $request->is_default_shipping,
                'is_default_billing'  => $request->is_default_billing,
                'user_id'             => $userId,
            ];
            $address = CustomerAddress::create($data);
            return $this->jsonResponse(new AddressResource($address),'Shipping Address create successfully',false);
        
    }

    public function updateShippingAddress(Request $request,$id){
        $userId = auth()->user()->id;
        $address = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->where('id',$id)->first();
        $validator = Validator::make($request->all(),[ 
            'division_id'           => 'required',
            'district_id'           => 'required',
            'zip_code'              => 'required',
            'address'               => 'required',
            'name'                  => 'required',
            'phone'                 => 'required',
            'address_type'          => 'required', 
            'is_default_shipping'   => 'required',
            'is_default_billing'    => 'required',
        ]);
        if($validator->fails()){
            return $this->jsonResponse([],$validator->getMessageBag()->first());
        }
       
        
        // if($request->is_default_shipping === 1){
        //     CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
        // }
        // if($request->is_default_billing === 1){
        //     CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
        // }
        $data = [
            'division_id'         => $request->division_id,
            'district_id'         => $request->district_id,
            'upazila_id'          => $request->upazila_id,
            'union_id'            => $request->union_id,
            'zip_code'            => $request->zip_code,
            'address'             => $request->address,
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type, 
            'is_default_shipping' => $request->is_default_shipping, 
            'user_id'             => $userId,
        ]; 

        $address->update($data);
        return $this->jsonResponse(new AddressResource($address->refresh()),'Address updated successfully',false);
    }

    public function deleteShippinggAddress($id){
        $address = CustomerAddress::findOrfail($id);
        $address->delete();

        return $this->jsonResponse([],'Shipping Address deleted successfully',false);
    }

    public function addressList(Request $request){
        $user = $request->user();
        $address = CustomerAddress::where('user_id',$user->id)->get();
        return $this->jsonResponse(new AddressCollection($address),'success',false);
    }

    public function getDistric(Request $request){ 
        $districtId = District::where('division_id',$request->division_id)->get();  
        if (is_null($districtId)){
            return $this->jsonResponseFaild('District was not found',false,404);
        }
        return new DistrictCollection($districtId);
    }

    public function getUpazila(Request $request){  
        $upazilaId = Upazila::where('district_id',$request->district_id)->get();   
        if (is_null($upazilaId)){
          return $this->jsonResponseFaild('Upazila was not found',false,404);
      }
       return new UpazilaCollection($upazilaId);
    }

    public function getUnion(Request $request){  
        $unionId = Union::where('upazila_id',$request->upazila_id)->get();    
        if (is_null($unionId)){
          return $this->jsonResponseFaild('Upazila was not found',false,404);
      }
       return new UpazilaCollection($unionId);
    }
 

}
