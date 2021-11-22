<?php

namespace App\Http\Controllers\Api\krishiProduct;

use App\Helpers\Baazar;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceOrder\KrishiOrderDetailsCollection;
use App\Http\Resources\PlaceOrder\KrishiOrderListCollection;
use App\Http\Resources\PlaceOrder\KrishiProductOrderCollection;
use App\Http\Traits\apiTrait;
use App\Models\Cart;
use App\Models\CustomerAddress;
use App\Models\KrishiOrderItem;
use App\Models\KrishiProduct;
use App\Models\Order;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlaceOrder\KrishiProductOrderResource;
use Illuminate\Support\Facades\Validator;

class KrishiOrderPlaceController extends Controller
{
    use apiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id; 
        $kProductOrderList = Order::where('customer_id',$userId)->where('order_type','krishi')->get(); 
       if($kProductOrderList){
        return new KrishiOrderListCollection($kProductOrderList);
       }else{
        return $this->jsonResponse([],'Krishi product not found',false);
       } 
    }

    public function orderDetails(Request $request){
        $userId = auth()->user()->id;
        $orderId  = $request->order_id;
        
        $kProductOrderDeatails = KrishiOrderItem::where('user_id',$userId)->where('order_id',$orderId)->get();
        if($kProductOrderDeatails){
            return new KrishiOrderDetailsCollection($kProductOrderDeatails);
        }else{
            return $this->jsonResponse([],'Krishi product detaisl not found',false);
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::check(); 
        if($user){ 
            $validator = Validator::make($request->all(),[
                'subtotal'           => 'required',
                'shipping_charge'    => 'required',
                'grand_total'        => 'required',
                'status'             => 'required', 
            ]);
    
            $userId = auth()->user()->id; 
            if($validator->fails()){
                return $this->jsonResponse([],$validator->getMessageBag()->first());
            }
           
            $billingAddressId = CustomerAddress::where('user_id',$userId)->where('is_default_billing',1)->first();
            $shippingAddressId = CustomerAddress::where('user_id',$userId)->where('is_default_shipping',1)->first();
            $shippingMethodId = ShippingMethod::where('user_id',$userId)->first();
            $productId = Cart::where('user_id',$userId)->get(); 
            $keyword = 'kp';
            $orderNumber = $this->orderNumber($keyword); 
            $data = [
                'customer_id' => $userId,
                'order_number' => $orderNumber,
                'customer_billing_address_id' => $billingAddressId->id,
                'customer_shipping_address_id' => $shippingAddressId->id,
                'shipping_method_id' => $shippingMethodId->id,
                'subtotal' => $request->subtotal,
                'shipping_charge' => $request->shipping_charge,
                'grand_total' => $request->grand_total,
                'order_type' => 'krishi',
                'status' => $request->status 
            ];
           
            $order = Order::create($data);
    
            $productID = $request->krishiProducts; 
             $a =[];
            foreach ($productID as $row){
                    $data = [
                    'krishi_product_id' => $row['krishi_product_id'],
                    'qty' => $row['qty'],
                    'unit' => $row['unit'], 
                    'rate' => $row['rate'],
                    'amount' => $row['amount'],
                    'user_id' => $userId,
                    'order_id' => $order->id,
                    'shop_id' => $row['shop_id']
                   ];
    
                // array_push($a, $data );
    
                KrishiOrderItem::create($data);
           
            } 
            $data =  new KrishiProductOrderResource($order);
            return $this->jsonResponse($data,'Krishi product order creae successfully',false); 
        }else{ 
            return response()->json([ 
                'message' => 'you are not authorize user'
            ]);
        }   
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
