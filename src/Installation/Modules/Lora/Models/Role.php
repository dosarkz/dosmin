<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Models;

use Dosarkz\Lora\Installation\Utilities\Models\I18nModel;

class Role extends I18nModel
{
    const STATUS_DEFAULT = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ru', 'name_en', 'alias', 'parent_role_id', 'status_id',
    ];

    public $timestamps = false;


    public function getStatusAttribute()
    {
        return array_key_exists($this->status_id, $this->statuses) ? $this->statuses[$this->status_id] : 'none';
    }

    public function getStatusesAttribute()
    {
        return [
            1   =>  trans('lora::base.default'),
            2 => trans('lora::base.active'),
            3   =>  trans('lora::base.deactivate')
        ];
    }

}
