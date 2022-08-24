<?php
return [
    'header-main-menu'  => [
        [
            'name'  => 'Nghị luận xã hội',
            'icon'  => '<i class="fa-solid fa-feather"></i>',
            'url'   => 'nghi-luan-xa-hoi'
        ],
        [
            'name'  => 'Nghị luận văn học',
            'icon'  => '<i class="fa-solid fa-feather"></i>',
            'url'   => 'nghi-luan-van-hoc',
            'child' => [
                [
                    'name'  => 'Văn Trung học Cơ Sở',
                    'icon'  => '',
                    'url'   => 'nghi-luan-van-hoc/van-trung-hoc-co-so',
                    'child' => [
                        [
                            'name'  => 'Lớp 6',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-co-so/lop-6'
                        ],
                        [
                            'name'  => 'Lớp 7',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-co-so/lop-7'
                        ],
                        [
                            'name'  => 'Lớp 8',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-co-so/lop-8'
                        ],
                        [
                            'name'  => 'Lớp 9',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-co-so/lop-9'
                        ]
                    ]
                ],
                [
                    'name'  => 'Văn Trung học Phổ Thông',
                    'icon'  => '',
                    'url'   => 'nghi-luan-van-hoc/van-trung-hoc-pho-thong',
                    'child' => [
                        [
                            'name'  => 'Lớp 10',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-10'
                        ],
                        [
                            'name'  => 'Lớp 11',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-11'
                        ],
                        [
                            'name'  => 'Lớp 12',
                            'icon'  => '',
                            'url'   => 'nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-12'
                        ]
                    ]
                ],
                [
                    'name'  => 'Văn nâng cao',
                    'icon'  => '',
                    'url'   => 'nghi-luan-van-hoc/nang-cao'
                ]
            ]
        ],
        [
            'name'  => 'Đọc - hiểu',
            'icon'  => '<i class="fa-solid fa-book-open"></i>',
            'url'   => 'doc-hieu-van-hoc'
        ],
        [
            'name'  => 'Tài liệu',
            'icon'  => '<i class="fa-regular fa-award"></i>',
            'url'   => 'tai-lieu-van-hoc',
            'child' => [
                [
                    'name'  => 'Lý Luận Văn Học',
                    'icon'  => '',
                    'url'   => 'tai-lieu-van-hoc/ly-luan-van-hoc'
                ],
                [
                    'name'  => 'Tác giả',
                    'icon'  => '',
                    'url'   => 'tai-lieu-van-hoc/tac-gia'
                ],
                [
                    'name'  => 'Tác phẩm',
                    'icon'  => '',
                    'url'   => 'tai-lieu-van-hoc/tac-pham'
                ]
            ]
        ],
        [
            'name'  => 'Đề thi',
            'icon'  => '<i class="fa-solid fa-clipboard-check"></i>',
            'url'   => 'de-thi-van-hoc',
            'child' => [
                [
                    'name'  => 'Lớp 6',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-6'
                ],
                [
                    'name'  => 'Lớp 7',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-7'
                ],
                [
                    'name'  => 'Lớp 8',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-8'
                ],
                [
                    'name'  => 'Lớp 9',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-9'
                ],
                [
                    'name'  => 'Lớp 10',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-10'
                ],
                [
                    'name'  => 'Lớp 11',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-11'
                ],
                [
                    'name'  => 'Lớp 12',
                    'icon'  => '',
                    'url'   => 'de-thi-van-hoc/de-thi-ngu-van-lop-12'
                ]
            ]
        ],
    ],
    'left-menu-admin'   => [
        [
            'name'      => 'Quản lí bài viết',
            'route'     => 'admin.blog.list',
            'icon'      => '<i data-feather=\'feather\'></i>',
            'child'     => [
                [
                    'name'  => '1. Danh sách',
                    'route' => 'admin.blog.list',
                    'icon'  => '<i data-feather=\'circle\'></i>'
                ],
                [
                    'name'  => '2. Thêm mới',
                    'route' => 'admin.blog.viewInsert',
                    'icon'  => '<i data-feather=\'circle\'></i>'
                ]
            ]
        ],
        [
            'name'      => 'Quản lí chuyên mục',
            'route'     => 'admin.category.list',
            'icon'      => '<i data-feather=\'bookmark\'></i>',
            'child'     => [
                [
                    'name'  => '1. Danh sách',
                    'route' => 'admin.category.list',
                    'icon'  => '<i data-feather=\'circle\'></i>'
                ],
                [
                    'name'  => '2. Thêm mới',
                    'route' => 'admin.category.viewInsert',
                    'icon'  => '<i data-feather=\'circle\'></i>'
                ]
            ]
        ],
        [
            'name'      => 'Quản lí Ảnh',
            'route'     => 'admin.image.list',
            'icon'      => '<i data-feather=\'bookmark\'></i>'
        ]
    ]
];