<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Shop;
use Sentinel;
use Session;
use Baazar;
use App\Models\InventoryAttributeOption;
class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $sellerProfile = Merchant::where('user_id',Sentinel::getUser()->id)->first();
//        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
//        $inventory = Inventory::all();
//        $item = Product::where('user_id',Sentinel::getUser()->id)->get();
//
//        $size= Size::all();
//        $color = Color::all();
//        return view ('merchant.inventory.index',compact('inventory','item','size','color','sellerProfile','shopProfile'));

        $inventories = Inventory::where('shop_id',Baazar::shop()->id)->with('item')->get();
        return view ('merchant.inventory.index',compact('inventories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventory = Inventory::all();
        $item = Product::where('user_id',Sentinel::getUser()->id)->get();
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
        $size= Size::all();
        $color = Color::all();
        $productAttriOption = InventoryAttributeOption::all();
        return view ('merchant.inventory.create',compact('inventory','item','size','color','shopProfile','productAttriOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Inventory $inventory,Request $request)
    {
        $shopId = Shop::where('user_id',Sentinel::getUser()->id)->first();
        $product = Product::where('user_id',Sentinel::getUser()->id)->first();
        $this->validateForm($request);
        $slug = Baazar::getUniqueSlug($inventory, $product->name);
        $data = [
            'product_id'    => $request->product_id,
            'slug'          => $slug,
            'color_id'      => $request->color_id,
            'size_id'       => $request->size_id,
            'price'         => $request->price,
            'qty_stock'     => $request->qty_stock,
            'special_price' => $request->special_price,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'shop_id'       => $shopId->id,
            'user_id'       => Sentinel::getUser()->id,
            'created_at'    => now(),
        ];

        Inventory::create($data);
        Session::flash('success', 'Inventory Added Successfully!');
        return redirect('merchant/inventories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {

        return view ('merchant.inventory.show',compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $inventory = Inventory::where('slug',$slug)->first();
        $item = Product::where('user_id',Sentinel::getUser()->id)->get();
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
        $size= Size::all();
        $color = Color::all();
        return view ('merchant.inventory.edit',compact('inventory','item','size','color','shopProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug)
    {
        $inventory= Inventory::where('slug',$slug)->first();
        $this->validateForm($request);
        $data = [
            'product_id'    => $request->product_id,
            'color_id'      => $request->color_id,
            'size_id'       => $request->size_id,
            'price'         => $request->price,
            'qty_stock'     => $request->qty_stock,
            'special_price' => $request->special_price,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'updated_at' => now(),
        ];
        $inventory->update($data);
        Session::flash('warning', 'Inventory update Successfully!');
        return redirect('merchant/inventories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();

        Session::flash('error', 'Inventory Deleted Successfully!');
        return redirect('merchant/inventories');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'product_id' => 'required',
            'color_id'   => 'required',
            'qty_stock'  => 'required',
            'price'      => 'required',
//            'size_id' => 'required',
        ]);
    }
}
