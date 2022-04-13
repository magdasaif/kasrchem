<?php
namespace App\Http\Interfaces;

interface GalleryInterface {
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function show_gallery($id);
    public function add_gallery_images($request,$id);
    public function delete_gallery_images($request ,$id);
    public function destroy($id);
    public function bulkDelete($request);
    public function yajra_data($request);

}
?>