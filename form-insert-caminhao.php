<?php
include_once 'verificalogin.php';

if ($_SESSION['id'] == true) {
} else {
    session_start();
}

ob_start();

include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';

$manager = new Manager();

include_once 'view/head.php';
include_once 'view/layout_lateral.php';
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <?php include_once 'view/card.php'; ?>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Prencha Os Campos</h5>
                            <span>Informações da Viagem</span>
                            <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <form method="POST" action="controller/insert_caminhao.php">
                            <div class="card-block">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Selecione Uma Categoria</label>
                                    <div class="col-sm-10">
                                        <select required name="categoria" class="form-control">
                                            <option value="">Selecione Uma Categoria</option>
                                            <?php foreach ($manager->listar('categoria') as $categoria) : ?>
                                                <option value="<?=$categoria['descricao']?>"><?=$categoria['descricao']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Data Cadastro</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="data_cadastro" class="form-control" placeholder="Data Cadastro">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Valor</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="valor" class="form-control" placeholder="Valor $0,00">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Observacao</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="5" name="obs" class="form-control" placeholder=""></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="motorista_id" value="<?=$_GET['id']?>" class="form-control">
                                <button type="submit" style="position:relative; margin-left: 200px" class="btn btn-info btn-round">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<?php include 'view/final_form.php'; ?>