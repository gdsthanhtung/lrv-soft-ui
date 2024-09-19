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
        'auth' => [
            'ctrl' => 'auth',
            'prefix' => 'auth',
            'view' => 'auth'
        ],
        'phongtro' => [
            'ctrl' => 'phongtro',
            'prefix' => 'phongtro',
            'view' => 'phong_tro'
        ],
        'congdan' => [
            'ctrl' => 'congdan',
            'prefix' => 'congdan',
            'view' => 'cong_dan'
        ],
        'hopdong' => [
            'ctrl' => 'hopdong',
            'prefix' => 'hopdong',
            'view' => 'hop_dong'
        ],
        'nhankhau' => [
            'ctrl' => 'nhankhau',
            'prefix' => 'nhankhau',
            'view' => 'nhan_khau'
        ],
        'hoadon' => [
            'ctrl' => 'hoadon',
            'prefix' => 'hoadon',
            'view' => 'hoa_don'
        ],
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
        'longNameId'    => array(),
        'ruleStatus'    => [
            'all'       => ['name' => 'Tất cả', 'class' => 'primary'],
            'active'    => ['name' => 'Kích hoạt', 'class' => 'success'],
            'inactive'  => ['name' => 'Chưa kích hoạt', 'class' => 'warning']
        ],
        'ruleStatusHoaDon'    => [
            'active'    => ['name' => 'Đã thanh toán', 'class' => 'success'],
            'inactive'  => ['name' => 'Chưa thanh toán', 'class' => 'warning'],
            'all'       => ['name' => 'Tất cả', 'class' => 'primary'],
            'unknown'   => ['name' => 'Không xác định', 'class' => 'danger']
        ],
        'selectStatus' => [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ],
        'selectStatusHoaDon' => [
            'active' => 'Đã thanh toán',
            'inactive' => 'Chưa thanh toán'
        ],
        'selectStatusDKTT' => [
            'active' => 'Đã đăng ký',
            'inactive' => 'Chưa đăng ký'
        ],
        'selectYesNo' => [
            '0' => 'No',
            '1' => 'Yes'
        ],
        'selectLevel' => [
            'class' => [
                'user' => 'secondary',
                'admin' => 'primary'
            ],
            'value' => [
                'user' => 'Người dùng',
                'admin' => 'Quản trị viên'
            ]
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
        ],
        'searchSelectionHopDong' => [
            'all' => ['name' => 'Tìm Tất cả'],
            'main.id' => ['name' => 'Tìm theo ID Hợp đồng'],
            'main.ma_hop_dong' => ['name' => 'Tìm theo Mã hợp đồng'],
            'cd.name' => ['name' => 'Tìm theo Tên công dân'],
            'cd.cccd_number' => ['name' => 'Tìm theo Số CCCD'],
            'pt.name' => ['name' => 'Tìm theo Số phòng'],
        ],
        'searchSelectionHoaDon' => [
            'all' => ['name' => 'Tìm Tất cả']
        ],
        'selectionInModule' => [
            'default' => ['all'],
            'user' => ['all', 'email', 'name'],
            'phongtro' => ['all', 'name'],
            'congdan' => ['all', 'name', 'cccd_number', 'address', 'phone'],
            'hopdong' => ['all', 'main.id', 'main.ma_hop_dong', 'cd.name', 'cd.cccd_number', 'pt.name'],
            'hoadon' => ['all'],
        ],
        'ruleBtn' => [
            'edit'      => ['class' => 'btn-primary',               'title' => 'Edit',    'icon' => 'fa-pencil',  'route' => "/form"],
            'delete'    => ['class' => 'btn-delete btn-danger',     'title' => 'Remove',           'icon' => 'fa-trash',   'route' => "/delete"],
            'info'      => ['class' => 'btn-info',                  'title' => 'Info',     'icon' => 'fa-info',    'route' => "/form"],
        ],
        'btnInArea' => [
            'default' => ['edit', 'delete'],
            'user' => ['edit', 'delete'],
            'phongtro' => ['edit', 'delete'],
            'congdan' => ['edit', 'delete'],
            'hopdong' => ['edit', 'delete'],
            'hoadon' => ['edit', 'delete'],
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
