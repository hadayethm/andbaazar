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
use Sentinel;
use Session;
use Baazar;

class ProductsController extends Controller
{
  public function __construct(){
    // $this->middleware('auth');//->except('store');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//      $sellerProfile = Merchant::where('user_id',Sentinel::getUser()->id)->first();
//      $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
//      $category = Category::all();
//      $item = Product::where('status','Active')->where('shop_id',$shopProfile->id)->get();
//      $size= Size::all();
//      $color = Color::all();
//      return view ('merchant.product.index',compact('category','item','size','color','sellerProfile','shopProfile'));

      $items = Product::where('status','Active')->where('shop_id',Baazar::shop()->id)->get();
      return view ('merchant.product.index',compact('items'));

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

        return view ('merchant.product.create',compact('category','categories','item','size','color','subCategories','tag','sellerId','shopProfile','childCategory'));
    }


    public function tagSlug($tags){
      $slug = '';
      foreach($tags as $tag){
        $slug .= $tag.',';
      }
      $slug = rtrim($slug,',');
      return $slug;
    }

    public function addInventory($request,$itemId,$shopId){
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
          'color_id'        => $color['id'],
          'color_name'      => $color['name'],
          'qty_stock'       => is_numeric($request->inventory_qty[$i])?$request->inventory_qty[$i]:0,
          'price'           => is_numeric($request->inventory_price[$i])?$request->inventory_price[$i]:0,
          'special_price'   => is_numeric($request->special_price[$i])?$request->special_price[$i]:0,
          'start_date'      => $request->startday[$i],
          'end_date'        => $request->endday[$i],
          'seller_sku'      => $request->seller_sku[$i],
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
              ];
              InventoryMeta::create($inventory_meta);
          }
        }
        $i++;
      }
    }

    public function addAttributes($attributes,$itemId){
      foreach($attributes as $id=>$att){
        $metas = [
          'attr_label'    => $id,
          'attr_value'    => $att,
          'attribute_id'  => $id,
          'product_id'       => $itemId,
        ];
        ItemMeta::create($metas);
      }
    }

    public function addImages($images, $itemId,$shop){
      foreach($images as $color => $image){
        foreach($image as $img){
          $i = 0;
          $image = [
            'product_id' => $itemId,
            'color_slug' => $color,
            'sort'      => ++$i,
            'org_img'     => Baazar::base64Upload($img,'orgimg',$shop->slug,$color),
          ];
          ItemImage::create($image);
        }
      }
    }

    public function store(Product $item, Request $request){
      // dd($request->all());
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
              'bn_description'=> $request->bn_description,
              'min_order'     => $request->min_order,
              'made_in'       => $request->made_in,
              'materials'     => $request->materials,
              'video_url'     => $request->video_url,
              'category_id'   => $request->category_id,
              'category_slug' => $request->category,
              'tag_slug'      => $this->tagSlug($request->tag_id),
              'shop_id'       => $shop->id,
              'user_id'       => Sentinel::getUser()->id,
              'created_at'    => now(),
          ];
        $item = Product::create($data);
        $this->addInventory($request,$item->id,$shop->id);
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
    public function show(Product $product)
    {
        $product = Product::with('itemimage')->where('slug',$product->slug)->first();

        return view('merchant.product.show',compact('product','shopProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $category = Category::all();
        $item = Product::all();
        $size= Size::all();
        $color = Color::all();
        $categories = Category::where('parent_id',0)->get();
        $subCategories = Category::where('parent_id','!=',0)->get();
        $tag = Tag::all();
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();

        return view ('merchant.product.edit',compact('category','categories','item','size','color','subCategories','product','tag','shopProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'image' => Baazar::fileUpload($request,'image','old_image','/uploads/product_image'),
            'price' => $request->price,
            'model_no' => $request->model_no,
            'org_price' => $request->org_price,
            'pack_id' => $request->pack_id,
            // 'sorting' => $request->sorting,
            'description' => $request->description,
            'min_order' => $request->min_order,
            // 'available_on' => $request->available_on,
            // 'availability' => $request->availability,
            'made_in' => $request->made_in,
            'sub_category' => $request->sub_category,
            'materials' => $request->materials,
            'labeled' => $request->labeled,
            'video_url' => $request->video_url,
            // 'total_sale_amount' => $request->total_sale_amount,
            'total_order_qty' => $request->total_order_qty,
            'last_ordered_at' => $request->last_ordered_at,
            'last_carted_at' => $request->last_carted_at,
            // 'total_view' => $request->total_view,
            // 'activated_at' => $request->activated_at,
            'category_id' => $request->category_id,
            'tag_id'      => $request->tag_id,
            'user_id' => Sentinel::getUser()->id,
            'update_at' => now(),
        ];



        $product->update($data);

        Session::flash('success', 'Product Added Successfully!');

        return back();
    }





    public function productList(){
    $category = Category::all();
      $item = Product::all();
      $size= Size::all();
      $color = Color::all();
     return view('merchant.product.product_list',compact('category','item','size','color'));
    }

     public function approvement($slug){


      $data = Product::where('slug',$slug)->first();

      $data->update(['status' => 'Active']);

      $name = $data['name'];
      \Mail::to($data['email'])->send(new productApproveMail($data, $name));
      Session::flash('success', 'Product Approve Successfully!');

        return back();

    }

    public function rejected(Request $request,$slug){


      $data = Product::where('slug',$slug)->first();


      $data->update([
        'status' => 'Reject',
        'rej_desc' => $request->rej_desc,
        ]);

      $name = $data['name'];
      $rej_desc = $data['rej_desc'];
      \Mail::to($data['email'])->send(new ProductRejectMail($data, $name,$rej_desc));
      Session::flash('success', 'Product Rejected Successfully!');

        return back();

    }

    public function subcategory(Request $request){
      $categoryId = $request->categoryId;
      return Product::getSubcategory($categoryId);
    }

    public function subCategoryChild(Request $request){
      $subCatId = $request->subCatId;
      return Product::getSubcategoryChild($subCatId);
    }

    public function childCategory(Request $request){
      $childCatId = $request->childCatId;
      return Product::getChildCategory($childCatId);
    }

    public function childCategory1(Request $request){
      $childCatid_1 = $request->childCatid_1;
      return Product::getChildCategory1($childCatid_1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        Session::flash('success', 'Product Deleted Successfully');

         return redirect('merchant/product');
    }

    public function vendorshow($slug){

    //  $product = Product::with('category')->where('user_id',Sentinel::getUser()->id)->first();
      $product = Product::with(['category','itemimage'])->where('slug',$slug)->first();
      $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
      return view('merchant.product.vendorshow',compact('product','shopProfile'));
    }


    // private function validateForm($request){
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'emial'=> 'required',
    //         'price' => 'required',
    //         'model_no' => 'required',
    //         'org_price' => 'required',
    //         'pack_id' => 'required',
    //         'min_order'=> 'required',
    //         'made_in' => 'required',
    //         'materials'=> 'required',
    //         'labeled' => 'required',
    //         // 'available_on' => 'required',
    //         // 'availability' => 'required',
    //         // 'activated_at' => 'required',


    //     ]);
    // }
}