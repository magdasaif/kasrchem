<?php
namespace App\Http\Interfaces;

interface PageInterface {
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function pages_images($page_id);
    public function add_page_images($request,$page_id);
    public function delete_page_images($request);
    public function destroy($id);
    public function bulkDelete($request);
    public function yajra_data($request);
    public function search($request);

}
?>