<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inv_category;
use App\Models\inv_supplier;
use App\Models\product;

class InventoryController extends Controller
{
    public function inventory_dashboard()
    {
        return view('inventory.dashboard');
    }


    public function active_categories()
    {
        $cat=inv_category::where('status','Active')->orderBy('category','ASC')->get();
        return view('inventory.category.ActiveCategory',['cat'=>$cat]);
    }

      public function category_add(Request $req)
    {
       
       if(inv_category::where('category',$req->cat)->exists())
       {
        $data['err']="error";
       }
       else
       {
                inv_category::create([
                'category'=>$req->cat,
                'status'=>'Active',

            ]) ;
            $data['success']="success";
        } 

        
        echo json_encode($data);
       
    }

     public function category_edit(Request $req)
    {
       
       if(inv_category::where('category',$req->cat)->where('id','!=',$req->buid)->exists())
       {
        $data['err']="error";
       }
       else
       {
                inv_category::where('id',$req->buid)->update([
                'category'=>$req->cat,
                'status'=>$req->status,

            ]) ;
            $data['success']="success";
        } 

        
        echo json_encode($data);
       
    }

    public function blocked_categories()
    {
        $cat=inv_category::where('status','Blocked')->orderBy('category','ASC')->get();
        return view('inventory.category.BlockedCategory',['cat'=>$cat]);
    }


    /////////////////////////////////

    public function add_supplier()
    {
        return view('inventory.suppliers.AddSupplier');
    }
    public function active_suppliers()
    {
        $supplier=inv_supplier::where('status','Active')->orderBy('name','ASC')->get();
        return view('inventory.suppliers.ActiveSuppliers',['supplier'=>$supplier]);
    }

      public function supplier_add(Request $req)
    {
       
       if(inv_supplier::where('name',$req->name)->exists())
       {
        $data['err']="error";
       }
       else
       {
                inv_supplier::create([
                'name'=>$req->name,
                'mobile'=>$req->mobile,
                'details'=>$req->details,
                'status'=>'Active',

            ]) ;
            $data['success']="success";
        } 

        
        echo json_encode($data);
       
    }

    public function edit_supplier($sid)
    {
        $supid=decrypt($sid);
        $supplier=inv_supplier::where('id',$supid)->first();
        return view('inventory.suppliers.EditSupplier',['supplier'=>$supplier]);
    }

     public function supplier_edit(Request $req)
    {
       
       if(inv_supplier::where('name',$req->name)->where('id','!=',$req->sid)->exists())
       {
        $data['err']="error";
       }
       else
       {
                inv_supplier::where('id',$req->sid)->update([
                'name'=>$req->name,
                'mobile'=>$req->mobile,
                'details'=>$req->details,
                'status'=>$req->status,

            ]) ;
            $data['success']="success";
        }     
        echo json_encode($data);    
     }

    public function blocked_suppliers()

    {
        $supplier=inv_supplier::where('status','Blocked')->orderBy('name','ASC')->get();
        return view('inventory.suppliers.BlockedSuppliers',['supplier'=>$supplier]);
    }

    ///////////////////////////////////


    public function add_product()
    {
        $cat=inv_category::where('status','Active')->orderBy('category','ASC')->get();
        return view('inventory.products.AddProduct',['cat'=>$cat]);
    }

     public function product_add(Request $req)
    {
       
       if(product::where('name',$req->name)->exists())
       {
        $data['err']="error";
       }
       else
       {
                product::create([

                'cat_id'=>$req->cat,
                'name'=>$req->name,
                'available_qty'=>0,
                'unit'=>$req->unit,
                'stockout_limit'=>$req->limit,
                'details'=>$req->details,
                'status'=>'Active',

            ]) ;
            $data['success']="success";
        } 

        
        echo json_encode($data);
       
    }

      public function stockin_products()
    {
        $products = product::where('available_qty','>','stockout_limit')
                    ->where('status', 'Active')
                    ->orderBy('name', 'ASC')
                    ->get();
        return view('inventory.products.StockInProducts',['products'=>$products]);
    }

        public function edit_product($pid)
    {
        $cat=inv_category::where('status','Active')->orderBy('category','ASC')->get();
        $prodid=decrypt($pid);
        $product=product::where('id',$prodid)->first();
        return view('inventory.products.EditProduct',['product'=>$product,'cat'=>$cat]);
    }

        public function product_edit(Request $req)
    {
       
       if(product::where('name',$req->name)->where('id','!=',$req->pid)->exists())
       {
        $data['err']="error";
       }
       else
       {
                product::where('id',$req->pid)->update([

                'cat_id'=>$req->cat,
                'name'=>$req->name,
                'unit'=>$req->unit,
                'stockout_limit'=>$req->limit,
                'details'=>$req->details,
                'status'=>$req->status,

            ]) ;
            $data['success']="success";
        } 

        
        echo json_encode($data);
       
    }

    public function blocked_products()
    {
        $products = product::where('status', 'Blocked')->orderBy('name', 'ASC')->get();
        return view('inventory.products.BlockedProducts',['products'=>$products]);
    }

      public function stockout_products()
    {
        $products = product::where('available_qty','<=','stockout_limit')
                    ->where('status', 'Active')
                    ->orderBy('name', 'ASC')
                    ->get();
        return view('inventory.products.StockOutProducts',['products'=>$products]);
    }



}
