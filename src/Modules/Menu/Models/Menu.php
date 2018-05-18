<?php

namespace App\Modules\Menu\Models;

use App\Modules\Role\Models\Role;
use Dosarkz\Dosmin\Models\I18nModel;
use Dosarkz\Dosmin\Models\Module;

class Menu extends I18nModel
{
    const TYPE_LEFT_SIDE_MENU = 1;
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ru', 'name_en','alias', 'type_id', 'module_id', 'status_id', 'user_id', 'position'
    ];

    public $timestamps = true;


    public function getTypesAttribute()
    {
        return [self::TYPE_LEFT_SIDE_MENU => trans('admin::base.left_menu')];
    }

    public function getModulesAttribute()
    {
        return Module::pluck('name_'.app()->getLocale(),'id');
    }

    public function getStatusAttribute()
    {
        return $this->statuses[$this->status_id];
    }

    public function getStatusesAttribute()
    {
        return [
            self::STATUS_DISABLE => trans('admin::base.deactivate'),
            self::STATUS_ACTIVE => trans('admin::base.active')
        ];
    }
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }

    public function menuParentItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->whereNull('parent_id');
    }

    public function scopeVisible($query)
    {
        return $query->whereHas('menuRoles', function($dubQuery){
            $dubQuery->whereHas('superUserRoles',function($userQuery){
                $userQuery->where('super_user_id', auth()->guard('admin')->user()->id);
            });
        });
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function menuRoles()
    {
        return $this->hasMany(MenuRole::class, 'menu_id');
    }

    public function menuRole($role_id)
    {
        return MenuRole::where('role_id', $role_id)->where('menu_id', $this->id)->first();
    }

}
