<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inv_category;
use App\Models\inv_supplier;
use App\Models\product;

class PurchaseController extends Controller
{
     public function add_purchase()
    {
        $cat=inv_category::where('status','Active')->orderBy('category','ASC')->get();
        $suppliers=inv_supplier::where('status','Active')->orderBy('name','ASC')->get();
        return view('inventory.purchase.AddPurchase',['cat'=>$cat,'suppliers'=>$suppliers]);
    }


        public function get_product(Request $req)
    {
        $cat_id = $req->cat_id;
        $products = product::where('cat_id', $cat_id)->where('status', 'Active')->orderBy('name','ASC')->get();

        $v = '';
        $val = "Choose..";

        echo "<option value=".$v.">".$val."</option>";
           
        
            foreach ($products as $p) {

                echo "<option value=" . $p->id . ">" .$p->name." </option>";
            }
    }

     public function get_unit(Request $req)
    {
 
        $product = product::where('id', $req->prod_id)->first();
        echo $product->unit;
           
    }
}
