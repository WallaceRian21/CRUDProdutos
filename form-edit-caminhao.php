<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';

$manager = new Manager();

$id = $_GET['id'];
// $id_motorista = $_GET['id_motorista'];
$id_motorista = 1;
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
                            <h5>Edite Os Campos</h5>
                            <span>Informações da Viagem</span>
                            <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <?php
                        foreach ($manager->getInfo('frota', $id) as $client_info) : ?>
                            <form method="POST" action="controller/update_caminhao.php">
                            <div class="card-block">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Selecione Uma Categoria</label>
                                    <div class="col-sm-10">
                                        <select required name="categoria" class="form-control">
                                            <option value="">Selecione Uma Categoria</option>
                                            <?php foreach ($manager->listar('categoria') as $categoria) : ?>
                                                <option value="<?=$categoria['descricao']?>" <?= $categoria['descricao'] == $client_info['categoria'] ? 'selected' : '' ?> ><?=$categoria['descricao']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Data Cadastro</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="data_cadastro" value="<?=$client_info['data_cadastro']?>" class="form-control" placeholder="Data Cadastro">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Observacao</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="5" name="obs" class="form-control" placeholder=""><?=$client_info['obs']?></textarea>
                                    </div>
                                </div>
                                    <input type="hidden" name="id" value="<?= $client_info['id'] ?>">
                                    <input type="hidden" name="motorista_id" value="<?= $id_motorista ?>">
                                    <button type="submit" style="position:relative; margin-left: 200px" class="btn btn-info btn-round">Salvar</button>
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