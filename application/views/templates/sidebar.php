<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- query menu -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "
    SELECT `user_menu`.`id`, `menu`
    FROM `user_menu` JOIN `user_access_menu`
    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
    WHERE `user_access_menu`.`role_id` = $role_id
    ORDER BY `user_access_menu`.`menu_id` ASC
    ";

    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <?php   if ($m['menu']=="Admin")
        {

        ?>
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <!-- SUB MENU-->
            <?php
            $menuId = $m['id'];
            $querySubmenu = "
            SELECT *
            FROM `user_sub_menu`
            WHERE `user_sub_menu`.`menu_id` = $menuId
            AND `user_sub_menu`.`is_active` = 1
            ";

            $subMenu = $this->db->query($querySubmenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
                <?php if ($title == $sm['title']) : ?>
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">

                    <?php else : ?>
                        <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

        <?php }?>
    <?php endforeach; ?>



     <!-- LOOPING MENU -->
     <?php $x=0; ?>
     <?php foreach ($menu as $m) : ?>
        <?php   if ($m['menu']=="Admin")
                {

                }
                else
                {
                ?>

                        <li class="nav-item">
                            <?php $string = preg_replace('/\s+/', '', $m['menu']); ?>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="<?php echo "#".$string;?>" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-folder"></i>
                            <span><?= $m['menu']; ?></span>
                            </a>

                            <div id="<?php echo $string; ?>" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            
                                <!-- SUB MENU-->
                                <?php
                                $menuId = $m['id'];
                                $querySubmenu = "
                                SELECT *
                                FROM `user_sub_menu`
                                WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                                ";

                                $subMenu = $this->db->query($querySubmenu)->result_array();
                                ?>
                            
                                <?php foreach ($subMenu as $sm) : ?>
                                    
                                        <a class="collapse-item" href="<?= base_url($sm['url']); ?>">
                                            <i class="<?= $sm['icon']; ?>"></i>
                                            <span><?= $sm['title']; ?></span></a>
                                    
                                
                                <?php endforeach; ?>
                            </div>
                            </div>
                        </li>


                    <?php
                    if($x==2)
                    {
                    ?>
                    <hr class="sidebar-divider mt-3">
                    <?php
                        $x=0;
                    }
                    else
                    {
                        $x+=1;
                    }
                    ?>


                <?php                    
                }
                
                ?>
    <?php endforeach; ?>

    <hr class="sidebar-divider mt-3">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->