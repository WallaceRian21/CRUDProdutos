<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';

$manager = new Manager();

$id = $_POST['id'];
if ($_SESSION['id'] == true) {
} else {
    session_start();
}

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
                                            <input type="text" readonly name="origem" class="form-control" value="<?= $client_info['origem'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Destino</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="destino" class="form-control" value="<?= $client_info['destino'] ?>" placeholder="Onde Você Carregou">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Transportadora</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="transportadora" class="form-control" value="<?= $client_info['transportadora'] ?>" placeholder="Onde você Descarregou">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Número da Nota</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="numero_nota" class="form-control" value="<?= $client_info['numero_nota'] ?>" placeholder="Quantos KM Voce Rodou com a Carga">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Valor do Frete</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="valor_frete" value="<?= number_format($client_info['valor_frete'], 2, ',', '.'); ?>" class="form-control" placeholder="Combustivel Utilizado">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Gasto Combustível</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="gasto_combustivel" class="form-control" value="<?= number_format($client_info['gasto_combustivel'], 2, ',', '.'); ?>" placeholder="Lucro Viagem">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Gasto Pedágio</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="gasto_pedagio" value="<?= number_format($client_info['gasto_pedagio'], 2, ',', '.'); ?>" class="form-control" placeholder="Preço Pago Pelo Cliente">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Descarga</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="descarga" class="form-control" value="<?= number_format($client_info['descarga'], 2, ',', '.'); ?>" placeholder="Descarga">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Total Lucro</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly name="total_lucro" class="form-control" value="<?= number_format($client_info['total_lucro'], 2, ',', '.'); ?>" placeholder="Total Lucro">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Status Pagamento</label>
                                        <div class="col-sm-10">
                                            <select readonly name="status_pagamento" class="form-control" value="<?= $client_info['status_pagamento'] ?>">
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
                                            <input type="date" readonly name="data_cadastro" class="form-control" value="<?= $client_info['data_cadastro'] ?>" placeholder="Data Cadastro">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OBS</label>
                                        <div class="col-sm-10">
                                            <textarea rows="5" readonly cols="5" name="observacao" class="form-control"><?= $client_info['observacao'] ?></textarea>
                                        </div>
                                    </div>
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