<?php

date_default_timezone_set('America/Bahia');

include_once 'verificalogin.php';
include_once 'log.php';
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';

if($_SESSION['nome'] == true) {
}else {
    session_start();
}
ob_start();

//Para Mostrar a Mensagem de Sucesso
$id = $_SESSION['id'];

$user = $_SESSION['nome'];
$pagina = "Viagens";
$data = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

logAcessso($user, $pagina, $data, $ip);

$manager = new Manager();

if($id == 5){
    header("Location: admin.php");
}

include 'view/head.php';
include 'view/layout_lateral.php';
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <?php include 'view/card.php'; ?>
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <br>
                            <h5>Tabela Viagens</h5>
                            <br>
                            <br>
                            <a href="form-insert.php" class="btn btn-info btn-round">+ Novo</a>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-chevron-left"></i></li>
                                    <!-- <li><a href="gerar_planilha.php"><i class="fa fa-window-maximize"></i></a></li> -->
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <!-- <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-times close-card"></i></li> -->
                                </ul>
                            </div>

                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Origem</th>
                                            <th>Destino</th>
                                            <th>Transportadora</th>
                                            <th>Número Nota</th>
                                            <th>Valor Frete</th>
                                            <th>Gasto Combustivel</th>
                                            <th>Gasto Pedágio</th>
                                            <th>Descarga</th>
                                            <th>Total Lucro</th>
                                            <th>Status Pagamento</th>
                                            <th>Data Cadastro</th>
                                            <th>Observação</th>
                                            <th>Km Inicial</th>
                                            <th>KM Final</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($manager->listViagensMes('viagens', date('n'), $id) as $client) : ?>
                                            <tr>
                                                <th scope="row"><?php echo $client['id']; ?></th>
                                                <th scope="row"><?php echo $client['origem']; ?></th>
                                                <th scope="row"><?php echo $client['destino']; ?></th>
                                                <th scope="row"><?php echo $client['transportadora']; ?></th>
                                                <th scope="row"><?php echo $client['numero_nota']; ?></th>
                                                <th scope="row"><?php echo number_format($client['valor_frete'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?php echo number_format($client['gasto_combustivel'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?php echo number_format($client['gasto_pedagio'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?php echo number_format($client['descarga'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?php echo number_format($client['total_lucro'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?= $client['status_pagamento'] ?></th>
                                                <th scope="row"><?php echo date('d/m/Y', strtotime($client['data_cadastro'])); ?></th>
                                                <th scope="row"><?php echo substr($client['observacao'], 0, 10); ?></th>
                                                <th scope="row"><?php echo substr($client['km_inicial'], 0, 10); ?></th>
                                                <th scope="row"><?php echo substr($client['km_final'], 0, 10); ?></th>
                                                <form method="post" action="form-edit.php">
                                                    <input type="hidden" name="id" value="<?= $client['id'] ?>">
                                                    <th scope="row"><button class="btn btn-primary btn-icon"><i class="icofont icofont-user-alt-3"></i></button></th>
                                                </form>
                                                <form method="post" action="controller/delete_client.php">
                                                    <input type="hidden" name="id" value="<?= $client['id'] ?>">
                                                    <th scope="row"><button type="submit" class="btn btn-danger btn-icon"onclick="return confirm('Você tem certeza que deseja excluir essa viagem ?');"><i class="ti-trash"></i></button></th>
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header card">
                    <div class="card-block">
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <?php
                                        $totalMesAtual = $manager->totalMes('viagens', date('n', strtotime($client['data_cadastro'])), 'valor_frete', $id);
                                        $totalPedagio = $manager->totalMes('viagens', date('n', strtotime($client['data_cadastro'])), 'gasto_pedagio', $id);
                                        $Totaldescarga = $manager->totalMes('viagens', date('n', strtotime($client['data_cadastro'])), 'descarga', $id);
                                        $Totallucro = $manager->totalMes('viagens', date('n', strtotime($client['data_cadastro'])), 'total_lucro', $id);
                                        $totalCombustivel = $manager->totalMes('viagens', date('n', strtotime($client['data_cadastro'])), 'gasto_combustivel', $id);
                                        $totalDespesas = $manager->totalDespesas('viagens', date('n', strtotime($client['data_cadastro'])), $id);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Frete bruto Total mês atual</th>
                                            <th>Total Combústivel</th>
                                            <th>Total Pedágio</th>
                                            <th>Total Descarga</th>
                                            <th>Total Lucro</th>
                                            <th>Total Livre</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr>
                                            <th scope="row"><?= number_format($totalMesAtual['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($totalCombustivel['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($totalPedagio['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($Totaldescarga['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($Totallucro['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($totalDespesas['total'], 2, ',', '.'); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/final.php'; ?>