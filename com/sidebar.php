<?PHP
  $sql_home = "SELECT gm.menu_file 
    FROM gen_menu_access gma 
    LEFT JOIN gen_menu gm ON gma.menu_id = gm.menu_id  
    WHERE gma.user_id = '$user_id' AND gm.menu_home = '1' AND gma.data_active = '1'";
    //echo $sql_home;
  $xsql_home = mysqli_query($koneksi,$sql_home);
  $arsql_home = mysqli_fetch_array($xsql_home);
  $Home_Url = $arsql_home['menu_file'];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4" 
    style="background-color: #cfeefd;  ">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="background-color:#cfeefd;">
        <img src="dist/img/edufund-logo-short-1.png"
            alt="Edufund Logo" 
            class="brand-image img-circle"
            style="opacity: .8;">
        <span class="brand-text font-weight-bolder text-primary">EDUFUND</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: none;">
            <div class="image">
                <?PHP 
                if (!empty($user_picture)){
                    $profile_picture = $user_picture;
                }
                else{
                    $profile_picture = "dist/img/blank-m.png";
                }
                ?>
                <img src="<?PHP echo $profile_picture; ?>" class="img-circle elevation-2 mt-2" alt="User Image">
            </div>
            <div class="info">
                <a onclick="javascript:load_right('<?PHP echo'pages/user/fown_profile.php'; ?>');" 
                    class="d-block text-navy" style="cursor: pointer;">
                    <strong><?PHP echo $user_nickname; ?></strong><br>
                    <small><i><?PHP echo $user_group_name; ?></i></small>
                </a>

            </div>
        </div>  

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?PHP
                $noid = 1;
                $sql_nav = "SELECT gm.menu_id,gm.menu_title,gm.menu_description,gm.menu_target,gm.menu_file,gm.menu_icon 
                    FROM gen_menu_access gma 
                    LEFT JOIN gen_menu gm ON gma.menu_id = gm.menu_id 
                    WHERE gma.User_id = '$user_id' AND gm.parent_id = '0'
                    AND gm.data_active = '1' 
                    AND gma.data_active = '1' 
                    ORDER BY gm.menu_order ASC";
                //echo $sql_nav;
                $xsql_nav = mysqli_query($koneksi, $sql_nav);
                while($arsql_nav = mysqli_fetch_array($xsql_nav)){
                    $nav_title = $arsql_nav['menu_title'];
                    $nav_description = $arsql_nav['menu_description'];
                    $nav_icon = $arsql_nav['menu_icon'];
                    $nav_url = $arsql_nav['menu_file'];
                    $nav_target = $arsql_nav['menu_target'];

                    $sql_sub = "SELECT gm.menu_id,gm.menu_title,gm.menu_description,gm.menu_target,gm.menu_file,gm.menu_icon 
                        FROM gen_menu_access gma 
                        LEFT JOIN gen_menu gm ON gma.menu_id = gm.menu_id 
                        WHERE gma.User_id = '$user_id' AND gm.parent_id = '$arsql_nav[menu_id]' 
                        AND gm.data_active = '1' AND gm.menu_id <> '$arsql_home[menu_id]' AND gma.data_active = '1' 
                        ORDER BY gm.menu_order ASC";
                    $xsql_sub = mysqli_query($koneksi, $sql_sub);
                    $nmsql_sub = mysqli_num_rows($xsql_sub);
                    if ($nmsql_sub > 0){
                        ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas <?PHP echo $nav_icon; ?> text-navy"></i>
                                <p class="text-navy">
                                    <?PHP echo $nav_title; ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pt-2 pb-1 mb-2">
                                <?PHP                    
                                    while($arsql_sub = mysqli_fetch_array($xsql_sub)){
                                        $sub_title = $arsql_sub['menu_title'];
                                        $sub_description = $arsql_sub['menu_description'];
                                        $sub_icon = "fa-check-circle";
                                        $sub_url = $arsql_sub['menu_file'];
                                        $sub_target = $arsql_sub['menu_target'];
                                        ?>
                                        <li class="nav-item" onclick="nav_map(<?PHP echo $noid; ?>)">
                                            <?PHP
                                            if ($sub_target == "self"){
                                                ?>
                                                <a onClick="javascript:load_right('<?PHP echo $sub_url; ?>','<?PHP echo $noid; ?>')" 
                                                    class="nav-link" style="cursor: pointer;">
                                                    <i class="far <?PHP echo $sub_icon; ?> nav-icon text-navy" 
                                                        id="<?PHP echo $noid; ?>"></i>
                                                    <p class="text-navy"><?PHP echo $sub_title; ?></p>
                                                </a>
                                                <?PHP
                                            }
                                            else{
                                                ?>
                                                <a href="<?PHP echo $sub_url; ?>" class="nav-link" style="cursor: pointer;">
                                                    <i class="far <?PHP echo $sub_icon; ?> nav-icon text-navy" 
                                                        id="<?PHP echo $noid; ?>"></i>
                                                    <p class="text-navy"><?PHP echo $sub_title; ?></p>
                                                </a>
                                                <?PHP
                                            }
                                            ?>
                                        </li>
                                        <?PHP
                                        $noid++;
                                    }
                                ?>
                            </ul>
                        </li>
                        <?PHP
                    }
                    else{
                        ?>
                        <li class="nav-item">
                            <?PHP
                            if ($nav_target == "self"){
                                ?>
                                <a onClick="javascript:load_right('<?PHP echo $nav_url; ?>')" 
                                    class="nav-link" style="cursor: pointer;">
                                    <i class="nav-icon fas <?PHP echo $nav_icon; ?> text-navy" id="<?PHP echo $noid; ?>"></i>
                                    <p class="text-navy"><?PHP echo $nav_title; ?></p>
                                </a>
                                <?PHP
                            }
                            else{
                                ?>
                                <a href="<?PHP echo $nav_url; ?>" class="nav-link" style="cursor: pointer;">
                                    <i class="nav-icon fas <?PHP echo $nav_icon; ?> text-navy" id="<?PHP echo $noid; ?>"></i>
                                    <p class="text-navy"><?PHP echo $nav_title; ?></p>
                                </a>
                                <?PHP
                            }
                            ?>            
                        </li>
                        <?PHP
                    }
                    $noid++;
                }
                ?>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>