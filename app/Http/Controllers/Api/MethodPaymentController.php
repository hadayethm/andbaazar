<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Http\Traits\apiTrait;
use App\MethodPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MethodPaymentController extends Controller
{
    use apiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $userId = auth()->user()->id;
        $paymentMethod = MethodPayment::where('user_id',$userId)->first();
        // dd($paymentMethod);
        if(empty($paymentMethod)){
            // dd('test');
        $validator = Validator::make($request->all(),[
            'type' => 'required',
            'full_name' => 'required', 
            'mobile' => 'required', 
            'account_numbe' => 'required',
            'bank_id' => 'required',
            'bank_branch_id' => 'required',
            'address' => 'required',
            'comment' => 'required', 
        ]);

        if($validator->fails()){
            return $this->jsonResponse([],$validator->getMessageBag()->first());
        }

            $data = [
                'type' => $request->type,
                'full_name' => $request->full_name, 
                'mobile' => $request->mobile, 
                'account_numbe' => $request->account_numbe,
                'bank_id' => $request->bank_id,
                'bank_branch_id' => $request->bank_branch_id,
                'address' => $request->address,
                'comment' => $request->comment,
                'user_id' => $userId
            ];
            $payment = MethodPayment::create($data);
            return $this->jsonResponse(new PaymentResource($payment),'success',false);
        }else{ 
            $validator = Validator::make($request->all(),[
                'type' => 'required',
                'full_name' => 'required', 
                'mobile' => 'required', 
                'account_numbe' => 'required',
                'bank_id' => 'required',
                'bank_branch_id' => 'required',
                'address' => 'required',
                'comment' => 'required', 
            ]);
    
            if($validator->fails()){
                return $this->jsonResponse([],$validator->getMessageBag()->first());
            }
            $userId = auth()->user()->id; 
                $data = [
                    'type' => $request->type,
                    'full_name' => $request->full_name, 
                    'mobile' => $request->mobile, 
                    'account_numbe' => $request->account_numbe,
                    'bank_id' => $request->bank_id,
                    'bank_branch_id' => $request->bank_branch_id,
                    'address' => $request->address,
                    'comment' => $request->comment,
                     'user_id' => $userId
                ];
                $payment = MethodPayment::where('user_id',$userId)->first();
                $payment->update($data);
                return $this->jsonResponse(new PaymentResource($payment),'success',false);
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
