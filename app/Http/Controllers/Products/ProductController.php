<?php

namespace App\Http\Controllers\Products;
use App\Http\Controllers\Controller;

use App\Http\Interfaces\ProductInterface;

use Illuminate\Http\Request;


use App\Http\Requests\ProductRequest;


//use Illuminate\Support\Facades\Schema;

use App\Traits\TableAutoIncreamentTrait;

class ProductController extends Controller
{
    use TableAutoIncreamentTrait;

    protected $xx;
    public function __construct(ProductInterface $y) {
        $this->xx = $y;
    }
    
    public function index(){
       return  $this->xx->index();
    }

    public function create(){
        return  $this->xx->create();
    }
    
    public function store(ProductRequest $request){
        return  $this->xx->store($request);
    }
    
    public function products_images($product_id)
    {
        return $this->xx->products_images($product_id);
    }

    public function add_product_images(Request $request,$product_id)
    {
        return $this->xx->add_product_images($request,$product_id);
    }
    
    public function delete_product_images(Request $request)
    {
        return $this->xx->delete_product_images($request);
    }

    
    public function products_files($product_id)
    {
        return $this->xx->products_files($product_id);
    }

    public function add_products_files(Request $request,$product_id)
    {
        return $this->xx->add_products_files($request,$product_id);
    }
    
    public function delete_products_files(Request $request)
    {
        return $this->xx->delete_products_files($request);
    }

    public function edit($id){
        return $this->xx->edit($id);
    }
    public function update(ProductRequest $request){
        return  $this->xx->update($request);
    }
 
    public function delete_product($id){
        return $this->xx->destroy($id);
    }
    public function deleteAll(Request $request){
        return $this->xx->bulkDelete($request);
    }
    
    public function yajra_data(Request $request){
        //  dd('ddddd');
          return $this->xx->yajra_data($request);
      }
      public function search(Request $request){
        //  dd('ddddd');
          return $this->xx->search($request);
      } 
}
