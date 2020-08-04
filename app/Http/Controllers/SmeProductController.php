<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ProductApproveRequestMail;
use App\Mail\productApproveMail;
use App\Mail\ProductRejectMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Merchant;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\ItemImage;
use App\Models\Shop;
use App\Models\Inventory;
use App\Models\InventoryMeta;
use App\Models\ItemMeta;
use Illuminate\Support\Str;
use App\Models\Brand;
use Sentinel;
use Session;
use Baazar;

class SmeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sellerProfile = Merchant::with('rejectvalue')->where('user_id',Sentinel::getUser()->id)->first();
        $product = Product::where('shop_id',Baazar::shop()->id)->where('type','sme')->paginate(10);

      // $items = Product::with('inventory')->paginate('10');
      

     if ($request->has('cat')){

        $product = Product::where('shop_id',Baazar::shop()->id)->where('category_id',$request->cat)->paginate(10);            
    } 
    
    if ($request->has('status')){   
      $product =Product::orderBy('status','asc')->Where('status',$request->status)->paginate(10);
    // dd($product);        
  } 
    $categories = ([
      'cat'      =>request('cat'),
      'status'   => request('status'),
  ]);

      return view ('merchant.product.smeProduct.index',compact('product','sellerProfile'));

   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $item = Product::all();
        $size= Size::all();
        $color = Color::all();
        $categories = Category::where('parent_id',0)->get();
        $subCategories = Category::where('parent_id','!=',0)->get();
        $childCategory = Category::where('parent_id','!=',0)->get();
        $tag = Tag::all();
        $sellerId = Merchant::where('user_id',Sentinel::getUser()->id)->first();
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
        return view ('merchant.product.smeProduct.create',compact('category','categories','item','size','color','subCategories','tag','sellerId','shopProfile','childCategory'));
    }


    public function tagSlug($tags){
      $slug = '';
      foreach($tags as $tag){
        $slug .= $tag.',';
      }
      $slug = rtrim($slug,',');
      return $slug;
    }
  

    public function addInventory($request,$itemId,$shopId,$slug){
        $i = 0;
        foreach($request->inventory_price as $row){
          if($request->inventory_color){
            $color = Color::where('name',$request->inventory_color[$i])->first()->toArray();
          }else{
            $color['id'] = 0;
            $color['name'] = 'no color';
          }
          $inventories = [
            'product_id'      => $itemId,
            'slug'            => Str::slug($slug.'-'.$itemId.$color['name'].rand(1000,10000)),
            'color_id'        => $color['id'],
            'color_name'      => $color['name'],
            'qty_stock'       => is_numeric($request->inventory_qty[$i])?$request->inventory_qty[$i]:0,
            'price'           => is_numeric($request->inventory_price[$i])?$request->inventory_price[$i]:0,
            'special_price'   => is_numeric($request->special_price[$i])?$request->special_price[$i]:0,
            'start_date'      => $request->startday[$i],
            'end_date'        => $request->endday[$i],
            'seller_sku'      => $request->seller_sku[$i],
            'type'            => 'sme',
            'shop_id'         => $shopId,
            'user_id'         => Sentinel::getUser()->id,
            'created_at'      => now(),
          ];
          $inventory = Inventory::create($inventories);
          if($request->inventoryAttr){
            foreach($request->inventoryAttr as $att=>$val){
                $inventory_meta = [
                  'name'        => $att,
                  'value'       => $val[$i],
                  'inventory_id'=> $inventory->id,
                  'product_id'  => $itemId,
                ];
                InventoryMeta::create($inventory_meta);
            }
          }
          $i++;
        }
      }

      public function addImages($images, $itemId,$shop){
        foreach($images as $color => $image){
          foreach($image as $img){
            $i = 0;
            $image = [
              'product_id' => $itemId,
              'color_slug' => $color,
              'sort'       => ++$i,
              'org_img'    => Baazar::base64Upload($img,'orgimg',$shop->slug,$color),
            ];
            ItemImage::create($image);
          }
        }
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $item, Request $request)
    {
        $shop = Merchant::where('user_id',Sentinel::getUser()->id)->first()->shop;
        if($shop){
          $slug = Baazar::getUniqueSlug($item,$request->name);
          $feature = Baazar::base64Upload($request->images['main'][0],$slug,$shop->slug,'featured');
            $data = [
                'name'          => $request->name,
                'bn_name'       => $request->bn_name,
                'slug'          => $slug,
                'image'         => $feature,
                'price'         => is_numeric($request->price)?$request->price:0,
                'model_no'      => $request->model_no,
                'org_price'     => is_numeric($request->org_price)?$request->org_price:0,
                'description'   => $request->description,
                'email'         => $request->email,
                'bn_description'=> $request->bn_description,
                'type'          => 'sme',
                'made_in'       => $request->made_in,
                'materials'     => $request->materials,
                'video_url'     => $request->video_url,
                'category_id'   => $request->category_id,
                'category_slug' => $request->category,             
                'tag_slug'      => $this->tagSlug($request->tag_id),
                'status'        => 'Pending',
                'shop_id'       => $shop->id,
                'user_id'       => Sentinel::getUser()->id,
                'created_at'    => now(),
            ];
          $item = Product::create($data);
          $this->addInventory($request,$item->id,$shop->id,$item->slug);
          if($request->attribute){
            $this->addAttributes($request->attribute,$item->id);
          }
          if($request->images){
            $this->addImages($request->images,$item->id,$shop);
          }
  
  
          // $name = $data['name'];
          //  \Mail::to($sellerId['email'])->send(new ProductApproveRequestMail($sellerId, $name));
          Session::flash('success', 'Product Added Successfully!');
         }else{
          return view('vendor-deshboard');
         }
  
          return back();
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