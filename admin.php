<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';

if($_SESSION['nome'] == true){
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
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <br>
                            <h5>Tabela Admin</h5>
                            <br>
                            <br>
                            <a href="form-insert-admin.php" class="btn btn-info btn-round">+ Novo</a>
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
                                            <th>Descricao</th>
                                            <th>Motorista</th>
                                            <th>Data Cadastro</th>
                                            <th>Valor</th>
                                            <th>Editar</th>
                                            <th>Exluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($manager->listar_mes('admin', date('n')) == NULL){
                                            echo 'Ainda Não Existe Registros';
                                        }else{
                                        foreach ($manager->listar_mes('admin', date('n')) as $client) : ?>
                                            <tr>
                                                <th scope="row"><?php echo $client['id']; ?></th>
                                                <th scope="row"><?php echo substr($client['obs'], 0, 40); ?></th>
                                                <?php
                                                $motorista = $client['caminhao'];

                                                if($motorista == 1){
                                                    $motorista = 'Elcio';
                                                }elseif ($motorista == 2){
                                                    $motorista = 'Geraldo';
                                                }elseif($motorista == 3) {
                                                    $motorista = 'Rodelmar';
                                                }
                                                ?>
                                                <th scope="row"><?php echo $motorista; ?></th>
                                                <th scope="row"><?php echo date('d/m/Y', strtotime($client['data_cadastro'])); ?></th>
                                                <th scope="row"><?php echo number_format($client['valor'], 2, ',', '.'); ?></th>
                                                <th scope="row"><a href="form-edit-admin.php?id=<?=$client['id']?>" class="btn btn-primary btn-icon"><i class="icofont icofont-user-alt-3"></i></a></th>
                                                <th scope="row"><a href="controller/delete_admin.php?id=<?=$client['id']?>" onclick="return confirm('Você tem certeza que deseja excluir esse registro ?');" class="btn btn-danger btn-icon"><i class="ti-trash"></i></a></th>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $totalDespesas1 = $manager->totalDespesas('viagens', date('n', strtotime($client['data_cadastro'])), 1);
//                    $totaladmin = $manager->totalAdmin('caminhao', date('n', strtotime($client['data_cadastro'])),  1);
                    //Fazer Para Outros Caminhoes geraldo e rodelmar
                    $totalDespesas2 = $manager->totalDespesas('viagens', date('n', strtotime($client['data_cadastro'])), 2);
                    $totalDespesas4 = $manager->totalDespesas('viagens', date('n', strtotime($client['data_cadastro'])), 4);
                    $totalcompleto = $totalDespesas1['total'] - $totaladmin['total'];
                ?>
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="page-body">
                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="card bg-c-blue order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20"> MB DBL - 7222</h6>
                                            <p class="m-b-0">Lucro Atual R$ <?= number_format($totalcompleto, 2, ',', '.'); ?><span class="f-right"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card bg-c-blue order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Carro Scania DAJ - 4124</h6>
                                            <p class="m-b-0">Lucro Atual R$ <?= number_format($totalDespesas2['total'], 2, ',', '.'); ?><span class="f-right"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card bg-c-blue order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Carro VW FEJ - 6C14</h6>
                                            <p class="m-b-0">Lucro Atual R$ <?= number_format($totalDespesas4['total'], 2, ',', '.'); ?><span class="f-right"></span></p>
                                        </div>
                                    </div>
                                </div>
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
                                        $total_reg = $totalDespesas1['total'] + $totalDespesas2['total'] +$totalDespesas4['total'];
                                        $TotalFgts = $manager->TotalFGTS('admin', date('n'));
                                        $TotalPecas = $manager->TotalPecas('admin', date('n'));
                                        $TotalPedagio = $manager->TotalPedagio('admin', date('n'));
                                        $TotalSeguro = $manager->TotalSeguro('admin', date('n'));
                                        $TotalRastreador = $manager->TotalRastreador('admin', date('n'));
                                        $TotalTudo = $manager->TotalTudoAdmin('admin', date('n'));
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Total Lucro Reg</th>
                                            <th>Total FGTS</th>
                                            <th>Total Peças</th>
                                            <th>Total Pedágio</th>
                                            <th>Total Seguro</th>
                                            <th>Total Rastreador</th>
                                            <th>Total Tudo</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr>
                                            <th scope="row"><?= number_format($total_reg, 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($TotalFgts['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($TotalPecas['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($TotalPedagio['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($TotalSeguro['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($TotalRastreador['total'], 2, ',', '.'); ?></th>
                                            <th scope="row"><?= number_format($TotalTudo['total'], 2, ',', '.'); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'view/final.php'; ?>