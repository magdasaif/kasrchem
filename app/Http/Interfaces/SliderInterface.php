<?php
namespace App\Http\Interfaces;

interface SliderInterface {
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($id);
    public function bulkDelete($request);
    public function yajra_data($request);
    public function search($request);

}
?>