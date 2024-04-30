<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
include_once 'verificalogin.php';

$manager = new Manager();

$id = $_GET['id'];
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
                        foreach ($manager->getInfo('admin', $id) as $client_info) : ?>
                            <form method="POST" action="controller/update_admin.php">
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Selecione o Caminhão</label>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $client_info['caminhao'];
                                            //                                                 die;
                                            ?>
                                            <select required name="caminhao" class="form-control">
                                                <option value="">Selecione Um Caminhão </option>
                                                <option value="1" <?php echo ($client_info['caminhao'] == 1) ? 'selected' : ''; ?>>DBL - Elcio</option>
                                                <option value="2" <?php echo ($client_info['caminhao'] == 2) ? 'selected' : ''; ?>>DAJ - Geraldo</option>
                                                <option value="3" <?php echo ($client_info['caminhao'] == 3) ? 'selected' : ''; ?>>FEJ - Rodelmar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Valor</label>
                                        <div class="col-sm-10">
                                            <input type="text" required name="valor" class="form-control" value="<?= $client_info['valor'] ?>" placeholder="Valor $0,00">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Data Cadastro</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="data_cadastro" class="form-control" value="<?= $client_info['data_cadastro'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Descrição</label>
                                        <div class="col-sm-10">
                                            <input type="text" required name="descricao" class="form-control" value="<?= $client_info['descricao'] ?>" placeholder="Boleto Pneu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OBS</label>
                                        <div class="col-sm-10">
                                            <textarea rows="5" cols="5" name="obs" class="form-control" placeholder=""><?= $client_info['obs'] ?></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $client_info['id'] ?>">
                                    <button type="submit" style="position:relative; margin-left: 200px" class="btn btn-info btn-round">Salvar</button>
                                <?php endforeach; ?>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'view/final_form.php'; ?>