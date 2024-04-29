<?php 

return [

    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Dashboard',
        'route' => 'dashboard',
        'active'=> 'dashboard',
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Categories',
        'route' => 'dashboard.categories.index',
        'active'=> 'dashboard.categories.*', 
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Products',
        'route' => 'dashboard.products.index',
        'active'=> 'dashboard.products.*',
        'badge' => 'New Update', 
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Orders',
        'route' => 'dashboard.categories.index',
        'active'=> 'dashboard.orders.*',
        'badge' => 'see new version', 
    ],
];