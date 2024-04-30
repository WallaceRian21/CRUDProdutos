<?php
date_default_timezone_set('America/Bahia');
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';
include_once 'log.php';

$manager = new Manager();

$id = $_POST['id'];
if ($_SESSION['id'] == true) {
} else {
    session_start();
}

$user = $_SESSION['nome'];
$pagina = "Editar Viagens";
$data = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

logAcessso($user, $pagina, $data, $ip);

include_once 'view/head.php';
include_once 'view/layout_lateral.php';
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
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Prencha Os Campos</h5>
                            <span>Informações da Viagem</span>
                            <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <?php
                        foreach ($manager->getInfo('viagens', $id) as $client_info) : ?>
                            <form method="POST" action="controller/update_client.php">
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Origem</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="origem" class="form-control" value="<?= $client_info['origem'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Destino</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="destino" class="form-control" value="<?= $client_info['destino'] ?>" placeholder="Onde Você Descarregou">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Transportadora</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="transportadora" class="form-control" value="<?= $client_info['transportadora'] ?>" placeholder="Para quem você Descarregou">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Número da Nota</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="numero_nota" class="form-control" value="<?= $client_info['numero_nota'] ?>" placeholder="Numero Nota CTE">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Valor do Frete</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="valor_frete" value="<?= $client_info['valor_frete']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Gasto Combustível</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="gasto_combustivel" class="form-control" value="<?= $client_info['gasto_combustivel']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Gasto Pedágio</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="gasto_pedagio" value="<?= $client_info['gasto_pedagio']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Descarga</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="descarga" class="form-control" value="<?= $client_info['descarga']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Total Lucro</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="total_lucro" class="form-control" value="<?= $client_info['total_lucro']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Status Pagamento</label>
                                        <div class="col-sm-10">
                                            <select name="status_pagamento" class="form-control" value="<?= $client_info['status_pagamento'] ?>">
                                                <option <?php if ($client_info['status_pagamento'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">Selecione o Status</option>
                                                <option <?php if ($client_info['status_pagamento'] == 'Adiantamento') {
                                                            echo 'selected';
                                                        } ?> value="Adiantamento">Adiantamento</option>
                                                <option <?php if ($client_info['status_pagamento'] == 'Pendente') {
                                                            echo 'selected';
                                                        } ?> value="Pendente">Pendente</option>
                                                <option <?php if ($client_info['status_pagamento'] == 'Pago') {
                                                            echo 'selected';
                                                        } ?> value="Pago">Pago</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Data Cadastro</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="data_cadastro" value="<?= $client_info['data_cadastro'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OBS</label>
                                        <div class="col-sm-10">
                                            <textarea rows="5" cols="5" name="observacao" class="form-control"><?= $client_info['observacao'] ?></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $client_info['id'] ?>">
                                    <input type="hidden" name="motorista_id" value="<?= $_SESSION['id'] ?>">
                                    <button type="submit" style="position:relative; margin-left: 200px" onclick="return confirm('Você tem certeza que deseja Editar esse Registro ?');" class="btn btn-info btn-round">Salvar</button>
                                <?php endforeach; ?>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'view/final_form.php'; ?>