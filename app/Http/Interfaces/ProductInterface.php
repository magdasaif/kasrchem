<?php
namespace App\Http\Interfaces;

interface ProductInterface {
    public function index();
    public function create();
    public function store($request);

    public function products_images($request);
    public function add_product_images($request,$product_id);
    public function delete_product_images($request);

    public function products_files($product_id);
    public function add_products_files($request,$product_id);
    public function delete_products_files($request);
    
    public function edit($id);
    public function update($request);
    public function destroy($id);
    public function bulkDelete($request);
    public function yajra_data($request);
    public function search($request);
    

}
?>