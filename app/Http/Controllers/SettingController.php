<?php

namespace App\Http\Controllers;
use App\Models\SiteInfo;
use App\Http\Requests\SettingRequest;
use App\Http\Interfaces\SiteInfoInterface;

class SettingController extends Controller
{
    protected $xx;
    public function __construct(SiteInfoInterface $y) {
        $this->xx = $y;
    }
    
    public function edit()
    {
        return $this->xx->edit();
    }

  
    public function update(SettingRequest $request)
    {
        return $this->xx->update($request);
    }

}
