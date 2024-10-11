<?php
if(!isset($_SESSION["usuario"])){
    ?>
    <script type="text/javascript">
        window.location.href="<?=URL?>/produccion/panel-administrativo/login.php";
    </script>
    <?php
}
//permisos de usuarios
$arr_usuarios = [
    'DESARROLLO' => [
        'adwords',
        'blog',
        'agregarauto',
        'promociones',
        'firmas',
        'unidades',
        'versiones',
        'colores_page',
        'codigos_qr',
        'planes_nissan',
        'politicas_rivero',
        'home',
    ],
    'TALLER' => [
        'adwords',
        'blog',
        'agregarauto',
        'promociones',
        'firmas',
        'unidades',
        'versiones',
        'colores_page',
        'codigos_qr',
        'planes_nissan',
        'politicas_rivero',
        'home',
    ],
    'MARKETING' => [
        'blog',
        'promociones',
        'unidades',
        'home',
    ],
    'POLITICAS' => [
        'politicas'
    ]
];
// echo  '<script>console.log(JSON.parse( JSON.stringy("'.  $arr_usuarios .'")) );</script>';
echo "<script>console.log(JSON.parse('".json_encode($arr_usuarios)."')); </script>";

?>
<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar" style="overflow-x: auto">
            <!-- User Info -->
            <?php if(in_array('home', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                <a href="https://www.riverorenta.mx/produccion/panel-administrativo/pages/home/">
            <?php } ?>
            <div class="user-info">
            </div></a>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>

 
                    <?php if(in_array('adwords', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                     <li class="<?= $adwords;?>">
                        <a href="<?=URLP?>pages/adwords">
                            <i class="material-icons">format_shapes</i>
                            <span>Adwords</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(in_array('blog', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $blog;?>">
                        <a href="<?=URLP?>pages/blog">
                            <i class="material-icons">developer_board</i>
                            <span>Blog</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(in_array('agregarauto', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $agregarauto;?>">
                        <a href="<?=URLP?>pages/agregarauto">
                            <i class="material-icons">no_crash</i>
                            <span>Agregar Auto</span>
                        </a>
                    </li> 
                    <?php } ?>

<!--                     <li class="<?= $contenido;?>">
                        <a href="<?=URLP?>pages/contenido-new-page">
                            <i class="material-icons">art_track</i>
                            <span>Pagina nueva</span>
                        </a>
                    </li> -->
                    <?php if(in_array('promociones', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $promociones;?>">
                        <a class="menu-toggle waves-effect waves-block" style="cursor: pointer">
                            <i class="material-icons">wb_iridescent</i>
                            <span>Promociones</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li class="<?= $promociones_autos?>">
                                <a href="<?=URLP?>pages/promociones-autos" class="">
                                    <span>Autos</span>
                                </a>                               
                            </li>
                            <li class="<?= $promociones_accesorios;?>">
                                <a href="<?=URLP?>pages/promociones-accesorios" class="">
                                    <span>Accesorios</span>
                                </a>
                            </li>
                            <li class="<?= $promociones_taller;?>">
                                <a href="<?=URLP?>pages/promociones-taller" class="">
                                    <span>Taller</span>
                                </a>                               
                            </li>
                        </ul>
                    </li>
                    <?php } ?>

<!--                <li class="<?= $accesorios;?>">
                        <a href="<?=URLP?>pages/accesorios">
                            <i class="material-icons">fitness_center</i>
                            <span>Accesorios</span>
                        </a>
                    </li> -->

                    <?php if(in_array('firmas', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $firmas;?>">
                        <a href="https://www.riverorenta.mx/produccion/firmas/" target="_blank">
                            <i class="material-icons">contact_mail</i>
                            <span>Firmas Email</span>
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(in_array('unidades', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $unidades;?>" style="<?=$mostrar;?>">
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="material-icons">directions_car</i>
                            <span>Unidades</span>
                        </a>
                        <ul class="ml-menu" style="display: none;">
                            <li class="<?= $nuevos;?>">
                                <a href="<?=URLP?>pages/unidades-nuevos" class="">
                                    <span>Nuevos</span>
                                </a>
                            </li>
                            <li class="<?= $seminuevos;?>">
                                <a href="<?=URLP?>pages/unidades-seminuevos" class="">
                                    <span>Seminuevos</span>
                                </a>                               
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <?php if(in_array('versiones', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $versiones;?>">
                        <a href="<?=URLP?>pages/versiones" class="">
                            <i class="material-icons">local_car_wash</i>
                            <span>Versiones</span>
                        </a>
                    </li> 
                    <?php } ?>
                    
                    <?php if(in_array('colores_page', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $colores_page;?>">
                        <a href="<?=URLP?>pages/colores" class="">
                            <i class="material-icons">color_lens</i>
                            <span>Colores</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(in_array('codigos_qr', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $codigos_qr;?>">
                        <a href="<?=URLP?>pages/codigos-qr" class="">
                            <i class="material-icons">select_all</i>
                            <span>Códigos QR</span>
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if(in_array('planes_nissan', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $planes_nissan;?>">
                        <a href="<?=URLP?>pages/planes-nissan" class="">
                            <i class="material-icons">attach_money</i>
                            <span>Planes Nissan</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('politicas', $arr_usuarios[$_SESSION["usuario"]]) ){ ?>
                    <li class="<?= $politicas_rivero;?>">
                        <a href="<?=URLP?>pages/politicas" class="">
                            <i class="material-icons">contact_mail</i>
                            <span>Politicas Rivero</span>
                        </a>
                    </li>
                    <?php } ?>
                    <!--<li>
                        <a href="pages/helper-classes.html">
                            <i class="material-icons">layers</i>
                            <span>Helper Classes</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Widgets</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/cards/basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/colored.html">Colored</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/no-header.html">No Header</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Infobox</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>User Interface (UI)</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/ui/alerts.html">Alerts</a>
                            </li>
                            <li>
                                <a href="pages/ui/animations.html">Animations</a>
                            </li>
                            <li>
                                <a href="pages/ui/badges.html">Badges</a>
                            </li>

                            <li>
                                <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                            </li>
                            <li>
                                <a href="pages/ui/buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="pages/ui/collapse.html">Collapse</a>
                            </li>
                            <li>
                                <a href="pages/ui/colors.html">Colors</a>
                            </li>
                            <li>
                                <a href="pages/ui/dialogs.html">Dialogs</a>
                            </li>
                            <li>
                                <a href="pages/ui/icons.html">Icons</a>
                            </li>
                            <li>
                                <a href="pages/ui/labels.html">Labels</a>
                            </li>
                            <li>
                                <a href="pages/ui/list-group.html">List Group</a>
                            </li>
                            <li>
                                <a href="pages/ui/media-object.html">Media Object</a>
                            </li>
                            <li>
                                <a href="pages/ui/modals.html">Modals</a>
                            </li>
                            <li>
                                <a href="pages/ui/notifications.html">Notifications</a>
                            </li>
                            <li>
                                <a href="pages/ui/pagination.html">Pagination</a>
                            </li>
                            <li>
                                <a href="pages/ui/preloaders.html">Preloaders</a>
                            </li>
                            <li>
                                <a href="pages/ui/progressbars.html">Progress Bars</a>
                            </li>
                            <li>
                                <a href="pages/ui/range-sliders.html">Range Sliders</a>
                            </li>
                            <li>
                                <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                            </li>
                            <li>
                                <a href="pages/ui/tabs.html">Tabs</a>
                            </li>
                            <li>
                                <a href="pages/ui/thumbnails.html">Thumbnails</a>
                            </li>
                            <li>
                                <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                            </li>
                            <li>
                                <a href="pages/ui/waves.html">Waves</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Forms</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                            </li>
                            <li>
                                <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-examples.html">Form Examples</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-validation.html">Form Validation</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-wizard.html">Form Wizard</a>
                            </li>
                            <li>
                                <a href="pages/forms/editors.html">Editors</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/normal-tables.html">Normal Tables</a>
                            </li>
                            <li>
                                <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                            </li>
                            <li>
                                <a href="pages/tables/editable-table.html">Editable Tables</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Medias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/medias/image-gallery.html">Image Gallery</a>
                            </li>
                            <li>
                                <a href="pages/medias/carousel.html">Carousel</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Charts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/charts/morris.html">Morris</a>
                            </li>
                            <li>
                                <a href="pages/charts/flot.html">Flot</a>
                            </li>
                            <li>
                                <a href="pages/charts/chartjs.html">ChartJS</a>
                            </li>
                            <li>
                                <a href="pages/charts/sparkline.html">Sparkline</a>
                            </li>
                            <li>
                                <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Example Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/examples/profile.html">Profile</a>
                            </li>
                            <li>
                                <a href="pages/examples/sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="pages/examples/sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="pages/examples/forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="pages/examples/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="pages/examples/404.html">404 - Not Found</a>
                            </li>
                            <li>
                                <a href="pages/examples/500.html">500 - Server Error</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Maps</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/maps/google.html">Google Map</a>
                            </li>
                            <li>
                                <a href="pages/maps/yandex.html">YandexMap</a>
                            </li>
                            <li>
                                <a href="pages/maps/jvectormap.html">jVectorMap</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Multi Level Menu</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item - 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 2</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Menu Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <span>Level - 3</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Level - 4</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    <li class="header">LABELS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li>-->
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div>
                    <a onclick="sessionn()">Cerrar sesion</a>
                </div>
                <br>
                <div class="copyright">
                    &copy; 2024 <a>Administracion - Grupo Rivero</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 2.0.1
                </div>
            </div>
            <script>
                function sessionn(){
                    var host = window.location.host; 
                    window.history.back();
                    window.location.replace('https://'+host+'/produccion/panel-administrativo/login.php');
                    console.log(host);
                }

            </script>
            <!-- #Footer -->
                

        </aside>
