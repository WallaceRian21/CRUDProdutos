<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="viagens.php">
                    <span class="pcoded-micon"><i class="ti-home"></i><b></b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="">
                <a href="relatorio.php">
                    <span class="pcoded-micon"><i class="ti-file"></i><b></b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Relatorios</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <?php if($_SESSION['id'] == 5) {
                echo ' <li class="">
                            <a href="relatorio_admin.php">
                                <span class="pcoded-micon"><i class="ti-server"></i><b></b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Relatorio Admin</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                      </li> ';
            } ?>
        </ul>
    </div>
</nav>