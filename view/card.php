<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">Bem vindo <?= ucfirst($_SESSION['nome']); ?></h5>
        <!--<p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p>-->
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="assets/index.html"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item"><a href="dashboard.php">reg</a>
            </li>
            <li class="breadcrumb-item"><a href="viagens.php"><?= ucfirst($_SESSION['nome']); ?></a>
            </li>
        </ul>
    </div>
</div>