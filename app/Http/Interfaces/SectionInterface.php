<?php
namespace App\Http\Interfaces;

interface SectionInterface {
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($id);
    public function bulkDelete($request);
    public function yajra_data($request);
    public function search($request);
    public function section_images($section_id);
    public function add_section_images($request,$section_id);
    public function delete_section_images($request);

}
?>