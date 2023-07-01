<?php

namespace App\Services;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;

class VnAddress
{
    public function getProvinces()
    {
        return Region::all();
    }

    public function getDistricts($province_id)
    {
        $districts = District::where('ma_tp', $province_id)->get();
        return $districts->pluck('ten', 'ma')->all();

    }

    public function getWards($district_id)
    {
        $ward = Ward::where('ma_qh', $district_id)->get();
        return $ward->pluck('ten', 'ma')->all();
    }
}
