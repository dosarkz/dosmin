<ul class="sidebar-menu">
    <li class="header">{{trans('admin::base.navigation')}}</li>
    @include('admin::navigation.menu',[
    'lists'=> \Dosarkz\Dosmin\Modules\Menu\Models\Menu::where('type_id', 1)
        ->visible()
        ->orderBy('position')
        ->get()
        ])


</ul>