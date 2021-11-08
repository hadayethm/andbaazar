<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wallet;
use App\WalletAccount;
use App\User;
use Baazar;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller
{

    public function walletTransaction(){

        try{
            $walletTransaction = Wallet::with('user')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
            return response()->json($walletTransaction);
        }catch (\Exception  $walletTransaction){
            return response()->json('fdfdf');
        }

    }


    public function AddBalance(Wallet $wallet, Request $request){

             $request->validate([
                'amount' => 'required|numeric|max:99999|min:10',
            ]);

            $str = Baazar::randString(8);
            $transId = Baazar::getUniqueSlug($wallet,$str,'tran_id');
            $wallet->tran_id = $transId;
            $wallet->amount = $request->amount;
            $wallet->previous_balance = Auth::user()->balance;
            $wallet->current_balance = Auth::user()->balance + $request->amount;
            $wallet->user_id = Auth::user()->id;
            $wallet->remarks = 'Balance add to the wallet';
            $walet = $wallet->save();

            if($walet){

                

                return response()->json(['msg' => 'Successfully balance add to the wallet' , 'error'=>true, 'code'=>200], 200);
 
            }
          


            // $data = [
            //     'store_id'          => config('settings.ssl_store_id'),
            //     'store_passwd'      => config('settings.ssl_store_pass'),
            //     'total_amount'      =>  $request->amount,
            //     'currency'          => 'BDT',
            //     'tran_id'           => $wallet->tran_id,
            //     'success_url'       =>  url('my-account/return-request'),
            //     'fail_url'          =>  url('my-account/return-request'),
            //     'cancel_url'        =>  url('my-account/return-request'),
            //     'cus_name'          => Auth::user()->name,
            //     'cus_email'         => Auth::user()->email ? Auth::user()->email : 'andit.andimpex@gmail.com',
            //     'cus_add1'          => Auth::user()->present_address ?  Auth::user()->present_address : 'some-where',
            //     'cus_add2'          => Auth::user()->permanent_address ?  Auth::user()->permanent_address : 'some-where',//Auth::user()->permanent_address,
            //     'cus_city'          => 'Bangladesh',
            //     'cus_country'       => 'Bangladesh',
            //     'cus_phone'         => Auth::user()->mobile ? Auth::user()->mobile : '01969516500',
            //     'shipping_method'   => 'NO',
            //     'product_name'      => 'AndtourTravel',
            //     'product_category'  => 'Tour',
            //     'product_profile'   => 'general',
            // ];

    
            // $client   = new \GuzzleHttp\Client();

            // $response = $client->request('POST', config('settings.ssl_create_api'),[
            //     'form_params' =>$data
            // ]);

            // if(json_decode($response->getBody())->status === 'SUCCESS'){
            //     return redirect(json_decode($response->getBody())->GatewayPageURL);
    
            // }else{
            //     Session::flash('error',json_decode($response->getBody())->failedreason);
            //     return redirect()->back();
            // }

    }

}
