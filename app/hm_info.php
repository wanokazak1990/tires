<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_info extends Model
{
    protected $fillable = [
        'name', 'slogan', 'phone', 'address', 'hours', 'weekend', 'admin_email', 'vk_group', 'logo', 'title_icon', 'map_code', 'metrics_code'
    ];

    public function getLogoUrl()
    {
    	$file = pathinfo($this->logo)['basename'];
        return asset('storage/settings/'.$file);
    }

    public function getTitleIconUrl()
    {
    	$file = pathinfo($this->title_icon)['basename'];
        return asset('storage/settings/'.$file);
    }
}
