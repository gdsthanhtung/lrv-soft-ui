<?php

return [
    'route' => [
        'prefix_admin' => 'admin',
        'dashboard' => [
            'ctrl' => 'dashboard',
            'prefix' => 'dashboard',
            'view' => 'dashboard'
        ],
        'user' => [
            'ctrl' => 'user',
            'prefix' => 'user',
            'view' => 'user'
        ],
        'role' => [
            'ctrl' => 'role',
            'prefix' => 'role',
            'view' => 'role'
        ],
        'permission' => [
            'ctrl' => 'permission',
            'prefix' => 'permission',
            'view' => 'permission'
        ],
        'room' => [
            'ctrl' => 'room',
            'prefix' => 'room',
            'view' => 'room'
        ]
    ],
    'format' => [
        'longTime' => 'd.m.Y H:m:s',
        'shortTime' => 'd.m.Y'
    ],
    'template' => [
        'formLabel' => [
            'class' => 'form-label'
        ],
        'formLabelRight' => [
            'class' => 'form-label text-right'
        ],
        'formInput' => [
            'class' => 'form-control'
        ],
        'formInputDateRange' => [
            'class' => 'form-control'
        ]
    ],
    'perPage' => [
        5, 10, 25, 50, 100
    ],
    'enum' => [
        'ruleStatus'    => [
            'all'       => ['name' => 'Tất cả', 'class' => 'primary'],
            'active'    => ['name' => 'Kích hoạt', 'class' => 'success'],
            'inactive'  => ['name' => 'Chưa kích hoạt', 'class' => 'warning']
        ],
        'selectStatus' => [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ],
        'selectYesNo' => [
            '0' => 'No',
            '1' => 'Yes'
        ],
        'searchSelection' => [
            'all' => ['name' => 'Tìm Tất cả'],
            'id' => ['name' => 'Tìm theo ID'],
            'name' => ['name' => 'Tìm theo Tên'],
            'email' => ['name' => 'Tìm theo Email'],
            'description' => ['name' => 'Tìm theo Mô tả'],
            'content' => ['name' => 'Tìm theo Nội dung'],
            'link' => ['name' => 'Tìm theo Link'],
            'cccd_number' => ['name' => 'Tìm số CCCD'],
            'address' => ['name' => 'Tìm theo Đ/C thường trú'],
            'phone' => ['name' => 'Tìm theo Số điện thoại'],
            'note' => ['name' => 'Tìm theo Ghi chú'],
        ],
        'selectionInModule' => [
            'default' => ['all'],
            'user' => ['all', 'email', 'name'],
            'role' => ['all', 'name'],
            'permission' => ['all', 'name'],
            'room' => ['all', 'name', 'note'],
        ],
        'ruleBtn' => [
            'edit'      => ['class' => 'btn-primary',               'title' => 'Edit',    'icon' => 'fa-pencil',  'route' => "edit"],
            'delete'    => ['class' => 'btn-delete btn-danger',     'title' => 'Remove',           'icon' => 'fa-trash',   'route' => "destroy"]
        ],
        'btnInArea' => [
            'default' => ['edit', 'delete'],
            'user' => ['edit', 'delete'],
            'role' => ['edit', 'delete'],
            'permission' => ['edit', 'delete'],
            'room' => ['edit', 'delete'],
        ],
        'gender' => [
            'M' => 'Men',
            'W' => 'Women'
        ],
        'defaultPath' => [
            'avatar' => 'default/avatar.jpg',
            'cccd_image_front' => 'default/cccd_front.jpg',
            'cccd_image_rear' => 'default/cccd_rear.jpg',
        ],
        'path' => [
            'congdan' => [
                'avatar' => 'congdan/avatar',
                'cccd_image_front' => 'congdan/cccd_image_front',
                'cccd_image_rear' => 'congdan/cccd_image_rear',
            ]
        ],
        'mqh' => [
            10  => 'Chủ hộ',
            20  => 'Ông nội',
            30  => 'Bà nội',
            40  => 'Ông ngoại',
            50  => 'Bà ngoại',
            60  => 'Chồng',
            70  => 'Vợ',
            80  => 'Con đẻ',
            90  => 'Cháu nội',
            100 => 'Cháu ngoại',
        ],
        'isCity' => [
            0 => 'Tỉnh',
            1 => 'Thành phố'
        ],
        'eRange' => [
            [
                "time" => "202408",
                "detail" => [
                    [
                        'limit'=> 100,
                        'price'=> 3000
                    ],[
                        'limit'=> 100,
                        'price'=> 3100
                    ],[
                        'limit'=> 100,
                        'price'=> 3200
                    ],[
                        'limit'=> 100,
                        'price'=> 3300
                    ],[
                        'limit'=> 100,
                        'price'=> 3400
                    ],[
                        'limit'=> 100,
                        'price'=> 3500
                    ],[
                        'limit'=> 100,
                        'price'=> 3600
                    ],[
                        'limit'=> 100,
                        'price'=> 3700
                    ],[
                        'limit'=> 100,
                        'price'=> 3800
                    ],[
                        'limit'=> 100,
                        'price'=> 3900
                    ],[
                        'limit'=> 100,
                        'price'=> 4000
                    ],[
                        'limit'=> 100,
                        'price'=> 4100
                    ],[
                        'limit'=> 100,
                        'price'=> 4200
                    ],[
                        'limit'=> 100,
                        'price'=> 4300
                    ],[
                        'limit'=> 100,
                        'price'=> 4400
                    ],[
                        'limit'=> 100,
                        'price'=> 4500
                    ],[
                        'limit'=> 100,
                        'price'=> 4600
                    ],[
                        'limit'=> 100,
                        'price'=> 4700
                    ],[
                        'limit'=> 100,
                        'price'=> 4800
                    ],[
                        'limit'=> 100,
                        'price'=> 4900
                    ],[
                        'limit'=> 100,
                        'price'=> 5000
                    ]
                ]
            ]
        ],
        'wRange' => [
            [
                "time" => "202408",
                "detail" => [
                    "price" => [
                        "0" => 15000,
                        "1" => 27000
                    ],
                    "limitM3" => [
                        "0" => 4,
                        "1" => 4
                    ]
                ]
            ]
        ],
        'hoaDon' => [
            'tienRac' => 30000,
            'tienNet' => 80000
        ]
    ]
];
