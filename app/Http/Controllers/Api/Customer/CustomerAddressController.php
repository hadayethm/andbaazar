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

    // public function createAddress(Request $request,CustomerAddress $address){
    //     $validator = Validator::make($request->all(),[
    //         'division_id'           => 'required',
    //         'district_id'           => 'required',
    //         'zip_code'              => 'required',
    //         'address'               => 'required',
    //         'name'                  => 'required',
    //         'phone'                 => 'required',
    //         'address_type'          => 'required',
    //         'is_default_shipping'   => 'required',
    //         'is_default_billing'    => 'required',
    //     ]);
    //     if($validator->fails()){
    //         return $this->jsonResponse([],$validator->getMessageBag()->first());
    //     }
    //     $user = $request->user();
        
    //     if($request->is_default_shipping === 1){
    //         CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
    //     }
    //     if($request->is_default_billing === 1){
    //         CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
    //     }
    //     $data = [
    //         'division_id'         => $request->division_id,
    //         'district_id'         => $request->district_id,
    //         'zip_code'            => $request->zip_code,
    //         'address'             => $request->address,
    //         'name'                => $request->name,
    //         'phone'               => $request->phone,
    //         'address_type'        => $request->address_type,
    //         'is_default_shipping' => $request->is_default_shipping,
    //         'is_default_billing'  => $request->is_default_billing,
    //         'user_id'             => $user->id,
    //     ];
    //     $address = CustomerAddress::create($data);
    //     return $this->jsonResponse(new AddressResource($address),'success',false);
    // }

    // public function updateAddress(Request $request,$id){
    //     $validator = Validator::make($request->all(),[
    //         // 'id'                    => 'required',
    //         'division_id'           => 'required',
    //         'district_id'           => 'required',
    //         'zip_code'              => 'required',
    //         'address'               => 'required',
    //         'name'                  => 'required',
    //         'phone'                 => 'required',
    //         'address_type'          => 'required',
    //         'is_default_shipping'   => 'required',
    //         'is_default_billing'    => 'required',
    //     ]);
    //     if($validator->fails()){
    //         return $this->jsonResponse([],$validator->getMessageBag()->first());
    //     }
    //     $user = $request->user();
        
    //     if($request->is_default_shipping === 1){
    //         CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
    //     }
    //     if($request->is_default_billing === 1){
    //         CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
    //     }
    //     $data = [
    //         'division_id'         => $request->division_id,
    //         'district_id'         => $request->district_id,
    //         'zip_code'            => $request->zip_code,
    //         'address'             => $request->address,
    //         'name'                => $request->name,
    //         'phone'               => $request->phone,
    //         'address_type'        => $request->address_type,
    //         'is_default_shipping' => $request->is_default_shipping,
    //         'is_default_billing'  => $request->is_default_billing,
    //         'user_id'             => $user->id,
    //     ];
    //     // dd($data);
    //     $address = CustomerAddress::where('user_id',$user->id)->where('id',$id)->first();
    //     $address->update($data);
    //     return $this->jsonResponse(new AddressResource($address->refresh()),'success',false);
    // }

    // public function delete(Request $request,$id){
    //     // $validator = Validator::make($request->all(),[
    //     //     'id'           => 'required',
    //     // ]);
    //     // if($validator->fails()){
    //     //     return $this->jsonResponse([],$validator->getMessageBag()->first());
    //     // }
    //     $user = $request->user();
    //     $address = CustomerAddress::where('user_id',$user->id)->where('id',$id)->delete();
    //     if($address){
    //         return $this->jsonResponse([],'Address deleted success',false);
    //     }
    //     return $this->jsonResponse([],'Address not deleted');
    // }

    //Billing address
    public function bllingAddress(Request $request){
        $userId = $request->user()->id; 

        $bllingAddressId = CustomerAddress::where('user_id',$userId)->where('is_default_billing',1)->first();
        $emailId = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->orWhere('is_default_billing',1)->select('user_id')->first();
    //    dd($emailId);
    if(empty($bllingAddressId)){ 
        if(empty($emailId)){
            $validator = Validator::make($request->all(),[
                'first_name'            => 'required',
                'last_name'             => 'required',  
                'phone'                 => 'required',
                'address_type'          => 'required',
                'is_default_shipping'   => 'required',
                'is_default_billing'    => 'required',
                'postal_code'           => 'required',
                'email'                 => 'required|email|unique:customer_addresses,email',
                'house_number'          => 'required',
                'floor_number'          => 'required',
                'street_address'        => 'required',
                'note'                  => 'required'
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'first_name'            => 'required',
                'last_name'             => 'required',  
                'phone'                 => 'required',
                'address_type'          => 'required',
                'is_default_shipping'   => 'required',
                'is_default_billing'    => 'required',
                'postal_code'           => 'required',
                'email'                 => 'sometimes|required|email|unique:customer_addresses,email,'.$emailId->id,
                'house_number'          => 'required',
                'floor_number'          => 'required',
                'street_address'        => 'required',
                'note'                  => 'required'
            ]);
        } 
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
            'first_name'          => $request->first_name,
            'last_name'           => $request->last_name,
            'division_id'         => 1,
            'district_id'         => 1,
            'upazila_id'          => 1,
            'union_id'            => 1,
            'zip_code'            => 123,
            'address'             =>'khulna',
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type, 
            'is_default_shipping' => $request->is_default_shipping,
            'is_default_billing'  => $request->is_default_billing,
            'postal_code'         => $request->postal_code,
            'email'               => $request->email,
            'house_number'        => $request->house_number,
            'floor_number'        => $request->floor_number,
            'street_address'      => $request->street_address,
            'note'                => $request->note,
            'user_id'             => $userId,
        ];
        $address = CustomerAddress::create($data);
        // dd($address);
        return $this->jsonResponse(new AddressResource($address),'Billing Address create successfully',false);
    }else{ 
        // $addressId = CustomerAddress::where('user_id',$userId)->where('is_default_billing',1)->first();
        // dd($addressId);
        if($emailId->user_id == $userId){
            $validator = Validator::make($request->all(),[
                'first_name'            => 'required',
                'last_name'             => 'required', 
                'phone'                 => 'required',
                'address_type'          => 'required',
                'is_default_shipping'   => 'required',
                'is_default_billing'    => 'required',
                'postal_code'           => 'required',
                'email'                 =>'sometimes|required|email',
                'house_number'          => 'required',
                'floor_number'          => 'required',
                'street_address'        => 'required',
                'note'                  => 'required'
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'first_name'            => 'required',
                'last_name'             => 'required', 
                'phone'                 => 'required',
                'address_type'          => 'required',
                'is_default_shipping'   => 'required',
                'is_default_billing'    => 'required',
                'postal_code'           => 'required',
                'email'                 => 'sometimes|required|email|unique:customer_addresses,email,'.$emailId->id,
                'house_number'          => 'required',
                'floor_number'          => 'required',
                'street_address'        => 'required',
                'note'                  => 'required'
            ]);
        } 
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
            'first_name'          => $request->first_name,
            'last_name'           => $request->last_name,
            'division_id'         => 1,
            'district_id'         => 1,
            'upazila_id'          => 1,
            'union_id'            => 1,
            'zip_code'            => 123,
            'address'             => 'khulna',
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type, 
            'is_default_shipping' => $request->is_default_shipping,
            'is_default_billing'  => $request->is_default_billing,
            'postal_code'         => $request->postal_code,
            'email'               => $request->email,
            'house_number'        => $request->house_number,
            'floor_number'        => $request->floor_number,
            'street_address'      => $request->street_address,
            'note'                => $request->note,
            'user_id'             => $userId,
        ];
         $bllingAddressId->update($data);
         $address = CustomerAddress::where('user_id',$userId)->where('is_default_billing',1)->first();  
        return $this->jsonResponse(new AddressResource($address),'Billing Address updated successfully',false);
    }            
        
    }

    public function bllingAddressInfo(Request $request){
        $userId = $request->user()->id;
   
        $billingAddress = CustomerAddress::where('user_id',$userId)->where('is_default_billing',1)->first();

        if($billingAddress){
            return $this->jsonResponse(new AddressResource($billingAddress),'Billing Address found successfully',false);
        }else{
            return $this->jsonResponse([],'Billing Address not found',false);
        } 
    } 

    

    

    //Shipping Address
    public function shippingAddress(Request $request){
        $userId = $request->user()->id; 
        $shippingAddressId = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->first();
        $emailId = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->orWhere('is_default_billing',1)->first(); 
        if(empty($shippingAddressId)){ 
            if(empty($emailId)){
                $validator = Validator::make($request->all(),[
                    'first_name'            => 'required',
                    'last_name'             => 'required',
                    'phone'                 => 'required',
                    'address_type'          => 'required',
                    'is_default_shipping'   => 'required',
                    'is_default_billing'    => 'required',
                    'postal_code'           => 'required',
                    'email'                 => 'required|email|unique:customer_addresses,email',
                    'house_number'          => 'required',
                    'floor_number'          => 'required',
                    'street_address'        => 'required',
                    'note'                  => 'required'
                ]);
            }else{ 
                $validator = Validator::make($request->all(),[
                    'first_name'            => 'required',
                    'last_name'             => 'required', 
                    'phone'                 => 'required',
                    'address_type'          => 'required',
                    'is_default_shipping'   => 'required',
                    'is_default_billing'    => 'required',
                    'postal_code'           => 'required',
                    'email'                 => 'sometimes|required|email|unique:customer_addresses,email,'.$emailId->id,
                    'house_number'          => 'required',
                    'floor_number'          => 'required',
                    'street_address'        => 'required',
                    'note'                  => 'required'
                ]);
            } 
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
                'first_name'          => $request->first_name,
                'last_name'           => $request->last_name,
                'division_id'         => 1,
                'district_id'         => 1,
                'upazila_id'          => 1,
                'union_id'            => 1,
                'zip_code'            => 123,
                'address'             => 'khulna', 
                'phone'               => $request->phone,
                'address_type'        => $request->address_type, 
                'is_default_shipping' => $request->is_default_shipping,
                'is_default_billing'  => $request->is_default_billing,
                'postal_code'         => $request->postal_code,
                'email'               => $request->email,
                'house_number'        => $request->house_number,
                'floor_number'        => $request->floor_number,
                'street_address'      => $request->street_address,
                'note'                => $request->note,
                'user_id'             => $userId,
            ];
            $address = CustomerAddress::create($data);
            return $this->jsonResponse(new AddressResource($address),'Shipping Address create successfully',false);
        }else{ 
            if($emailId->user_id == $userId){
                $validator = Validator::make($request->all(),[
                    'first_name'            => 'required',
                    'last_name'             => 'required',
                    'phone'                 => 'required',
                    'address_type'          => 'required',
                    'is_default_shipping'   => 'required',
                    'is_default_billing'    => 'required',
                    'postal_code'           => 'required',
                    'email'                 => 'sometimes|required|email',
                    'house_number'          => 'required',
                    'floor_number'          => 'required',
                    'street_address'        => 'required',
                    'note'                  => 'required'
                ]);
            }else{
                $validator = Validator::make($request->all(),[
                    'first_name'            => 'required',
                    'last_name'             => 'required',
                    'phone'                 => 'required',
                    'address_type'          => 'required',
                    'is_default_shipping'   => 'required',
                    'is_default_billing'    => 'required',
                    'postal_code'           => 'required',
                    'email'                 => 'sometimes|required|email|unique:customer_addresses,email,'.$emailId->id,
                    'house_number'          => 'required',
                    'floor_number'          => 'required',
                    'street_address'        => 'required',
                    'note'                  => 'required'
                ]);
            } 
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
                'first_name'          => $request->first_name,
                'last_name'           => $request->last_name,
                'division_id'         => 1,
                'district_id'         => 1,
                'upazila_id'          => 1,
                'union_id'            => 1,
                'zip_code'            => 123,
                'address'             => 'khulna',
                'phone'               => $request->phone,
                'address_type'        => $request->address_type, 
                'is_default_shipping' => $request->is_default_shipping,
                'is_default_billing'  => $request->is_default_billing,
                'postal_code'         => $request->postal_code,
                'email'               => $request->email,
                'house_number'        => $request->house_number,
                'floor_number'        => $request->floor_number,
                'street_address'      => $request->street_address,
                'note'                => $request->note,
                'user_id'             => $userId,
            ];
           $shippingAddressId->update($data);
           $address = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->first(); 
            return $this->jsonResponse(new AddressResource($address),'Shipping Address update successfully',false);
        }       
    }
 

    public function shippingAddressInfo(Request $request){
        $userId = $request->user()->id;
   
        $shippingAddress = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->first();

        if($shippingAddress){
            return $this->jsonResponse(new AddressResource($shippingAddress),'Shipping Address found successfully',false);
        }else{
            return $this->jsonResponse([],'Shipping Address not found',false);
        } 
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
