<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';

if($_SESSION['nome'] == true) {
}else {
    session_start();
}
ob_start();

$id = $_SESSION['id'];

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
                    <?php  if($manager->listRelatorioAdmin('admin') == NULL){
                        echo 'Ainda Não Existe Viagem';
                    }else{
                        foreach ($manager->listRelatorioAdmin('admin') as $mesReferencia => $listaViagens) : ?>
                            <div class="card">
                                <div class="card-header">
                                    <br>
                                    <h5>Relatorio Mês <?= ucfirst(utf8_encode($mesReferencia)); ?> - <?=ucfirst($_SESSION['nome']); ?></h5>
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
                                                <th>Categoria</th>
                                                <th>Data Cadastro</th>
                                                <th>Valor</th>
                                                <th>Observação</th>
                                                <th>Visualizar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($listaViagens as $client) : ?>
                                                <tr>
                                                    <th scope="row"><?php echo $client['id']; ?></th>
                                                    <th scope="row"><?php echo $client['categoria']; ?></th>
                                                    <th scope="row"><?php echo number_format($client['valor'], 2, ',', '.'); ?></th>
                                                    <th scope="row"><?php echo date('d/m/Y', strtotime($client['data_cadastro'])); ?></th>
                                                    <th scope="row"><?php echo substr($client['obs'], 0, 40); ?></th>
<!--                                                    <form method="post" action="visualizar.php">-->
<!--                                                        <input type="hidden" name="id" value="--><?php //= $client['id'] ?><!--">-->
<!--                                                        <th scope="row"><button class="btn btn-success btn-icon"><i class="ti-eye"></i></button></th>-->
<!--                                                    </form>-->
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <?php
                                                $mes = substr($client['data_cadastro'],5,2);
                                                $totalCobustivel = $manager->TotalCOMBUSTIVEL('admin', $mes);
                                                $totalPedagio = $manager->TotalPedagio('admin', $mes);
                                                $totalpecas = $manager->TotalPecas('admin', $mes);
                                                $totalseguro = $manager->TotalSeguro('admin', $mes);
                                                $totalrastreador = $manager->TotalRastreador('admin', $mes);
                                                $totalrastreador = $manager->TotalTudoAdmin('admin', $mes);
                                            ?>
                                            <thead>
                                            <tr>
                                                <th>Total Combústivel</th>
                                                <th>Total Pedágio</th>
                                                <th>Total Peças</th>
                                                <th>Total Seguro</th>
                                                <th>Total Rastreador</th>
                                                <th>Total Tudo</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row"><?= number_format($totalCobustivel['total'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?= number_format($totalPedagio['total'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?= number_format($totalpecas['total'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?= number_format($totalseguro['total'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?= number_format($totalrastreador['total'], 2, ',', '.'); ?></th>
                                                <th scope="row"><?= number_format($totalrastreador['total'], 2, ',', '.'); ?></th>
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
<?php include 'view/final.php'; ?>
