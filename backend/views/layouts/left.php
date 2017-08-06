<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index']],
                    ['label' => 'Person', 'icon' => 'user-circle', 'url' => ['/person/index']],
                    ['label' => 'Mail', 'icon' => 'envelope-open-o', 'url' => ['/mail/index']],
                    ['label' => 'Event', 'icon' => 'folder-open-o', 'url' => '#', 'items' => [
                        ['label' => 'Event Type', 'icon' => 'code-fork', 'url' => ['/event-type/index']],
                        ['label' => 'Event', 'icon' => 'calendar-check-o', 'url' => ['/event/index']],
                        ['label' => 'Event Participant', 'icon' => 'users', 'url' => ['/event-participant/index']],
                    ]],
                    ['label' => 'Quesionnaire', 'icon' => 'folder-open-o', 'url' => '#', 'items' => [
                        ['label' => 'Event Quesionnaire Template', 'icon' => 'archive', 'url' => ['/event-quesionnaire-template/index']],
                        ['label' => 'Event Quesionnaire', 'icon' => 'file-word-o', 'url' => ['/event-quesionnaire/index']],
                        ['label' => 'Participant Quesionnaire', 'icon' => 'check-square-o', 'url' => ['/participant-quesionnaire/index']],
                    ]],
                    ['label' => 'Report', 'icon' => 'files-o', 'url' => ['/site/report']],
                    ['label' => 'Settings', 'icon' => 'wrench', 'items' => [
                        ['label' => 'Jabatan Karyawan', 'icon' => 'sitemap', 'url' => ['/employee-position/index']],
                        ['label' => 'Divisi Karyawan', 'icon' => 'code-fork', 'url' => ['/division/index']],
                        ['label' => 'Kelas Pelanggan', 'icon' => 'signal', 'url' => ['/customer-grade/index']],
                        ['label' => 'Term of Payment', 'icon' => 'sort-numeric-asc', 'url' => ['/term-of-payment/index']],
                        ['label' => 'Kota', 'icon' => 'map-o', 'url' => ['/city/index']],
                        ['label' => 'Provinsi', 'icon' => 'map', 'url' => ['/province/index']],
                        ['label' => 'Bawah Nota', 'icon' => 'tag', 'url' => ['/bill-footer/index']],
                        ['label' => 'Parameter', 'icon' => 'cog', 'url' => ['/parameter/index']],
                        //['label' => 'Printer', 'icon' => 'print', 'url' => ['/printer/index']],
                        ['label' => 'Login Admin', 'icon' => 'user', 'url' => ['/user/index?UserSearch[ltrole]=999']],
                        ['label' => 'Login Peserta', 'icon' => 'user', 'url' => ['/user/index?UserSearch[gtrole]=1000']],
                    ]],
                    ['label' => 'Login', 'icon' => 'sign-in', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Same tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
