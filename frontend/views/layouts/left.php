<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index']],
                    ['label' => 'Profile', 'icon' => 'id-card-o', 'url' => ['/person/index']],
                    ['label' => 'Mail', 'icon' => 'envelope-open-o', 'url' => ['/mail/index']],
                    ['label' => 'Event', 'icon' => 'calendar', 'url' => ['/event/index']],
                    ['label' => 'Registered Events', 'icon' => 'calendar-check-o', 'url' => ['/event/registered']],
                    ['label' => 'Past Events', 'icon' => 'calendar-times-o', 'url' => ['/event/past']],
                    ['label' => 'Notification', 'icon' => 'code-fork', 'url' => ['/site/notification']],
                    ['label' => 'Report', 'icon' => 'files-o', 'url' => ['/site/report']],
                ],
            ]
        ) ?>

    </section>

</aside>
