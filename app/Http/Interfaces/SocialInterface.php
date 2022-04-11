<?php
namespace App\Http\Interfaces;

interface SocialInterface {
    public function index();
    public function yajra_data($request);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($id);
    public function bulkDelete($request);
}
?>