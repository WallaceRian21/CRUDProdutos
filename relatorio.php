<?php
date_default_timezone_set('America/Bahia');
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';
include_once 'log.php';

if($_SESSION['nome'] == true) {
}else {
    session_start();
}
ob_start();

$id = $_SESSION['id'];

$user = $_SESSION['nome'];
$pagina = "Relatório Viagens";
$data = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

logAcessso($user, $pagina, $data, $ip);

$manager = new Manager();

include 'view/head.php';
include 'view/layout_lateral.php';
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <?php include 'view/card.php'; ?>
                </div>
                <div class="page-body">
                    <?php  if($manager->listViagensMes1('viagens', $id) == NULL){
                        echo 'Ainda Não Existe Viagem';
                    }else{
                    foreach ($manager->listViagensMes1('viagens', $id) as $mesReferencia => $listaViagens) : ?>
                        <div class="card">
                           <?php

                           $mes = substr($mesReferencia, 0, 3);

                           if ($mes === "Jan") {
                               $mes = "Janeiro";
                           } elseif ($mes === "Feb") {
                               $mes = "Fevereiro";
                           } elseif ($mes === "Mar") {
                               $mes = "Marco";
                           } elseif ($mes === "Apr") {
                               $mes = "Abril";
                           } elseif ($mes === "May") {
                               $mes = "Maio";
                           } elseif ($mes === "Jun") {
                               $mes = "Junho";
                           } elseif ($mes === "Jul") {
                               $mes = "Julho";
                           } elseif ($mes === "Aug") {
                               $mes = "Agosto";
                           } elseif ($mes === "Sep") {
                               $mes = "Setembro";
                           } elseif ($mes === "Oct") {
                               $mes = "Outubro";
                           } elseif ($mes === "Nov") {
                               $mes = "Novembro";
                           } elseif ($mes === "Dec") {
                               $mes = "Dezembro";
                           } else {
                               echo "Mês inválido";
                           }


                            ?>
                            <div class="card-header">
                                <br>
                                <h5>Relatorio Mês <?= ucfirst(utf8_encode($mes)); ?> - <?=ucfirst($_SESSION['nome']); ?></h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa-chevron-left"></i></li>
                                        <li><a href="gerar_pdf.php?mes=<?=strftime('%m', strtotime($listaViagens["0"]['data_cadastro'])).'&nome_mes='.ucfirst(utf8_encode($mesReferencia)).'&nome='.ucfirst($_SESSION['nome']);?>"><i class="fa fa-file-pdf-o"></a></i></li>
                                        <li><a href="gerar_planilha.php?mes=<?=strftime('%m', strtotime($listaViagens["0"]['data_cadastro'])).'&nome_mes='.ucfirst(utf8_encode($mesReferencia)).'&nome='.ucfirst($_SESSION['nome']);?>"><i class="fa fa-file-excel-o"></i></a></li>
                                        <li><i class="fa minimize-card fa-plus"></i></li>
                                        <!-- <li><i class="fa fa-refresh reload-card"></i></li> -->
                                        <!-- <li><i class="fa fa-times close-card"></i></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block table-border-style" style="display: none">
                                <br>
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
                                                <th>Visualizar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listaViagens as $client) : ?>
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
                                                    <th scope="row"><?php
                                                                    if ($client['status_pagamento'] == 0) {
                                                                        echo 'Colocar Status';
                                                                    } elseif ($client['status_pagamento'] == 1) {
                                                                        echo 'Adiantamento';
                                                                    } else if ($client['status_pagamento'] == 2) {
                                                                        echo 'Pendente';
                                                                    } else if ($client['status_pagamento'] == 3) {
                                                                        echo 'Pago';
                                                                    } ?></th>
                                                    <th scope="row"><?php echo date('d/m/Y', strtotime($client['data_cadastro'])); ?></th>
                                                    <th scope="row"><?php echo substr($client['observacao'], 0, 10); ?></th>
                                                    <form method="post" action="visualizar.php">
                                                        <input type="hidden" name="id" value="<?= $client['id'] ?>">
                                                        <th scope="row"><button class="btn btn-success btn-icon"><i class="ti-eye"></i></button></th>
                                                    </form>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
                    <?php endforeach; 
                      }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php include 'view/final.php'; ?>