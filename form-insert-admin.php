<?php
include_once 'verificalogin.php';

if ($_SESSION['id'] == true) {
} else {
    session_start();
}

include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';

$manager = new Manager();

ob_start();

include_once 'view/head.php';
include_once 'view/layout_lateral.php';
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Prencha Os Campos</h5>
                            <span>Informações da Administração</span>
                            <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <form method="POST" action="controller/insert_admin.php">
                            <div class="card-block">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Selecione o Caminhão</label>
                                    <div class="col-sm-10">
                                        <select required name="caminhao" class="form-control">
                                            <option value="">Selecione Um Caminhão </option>
                                            <option value="1">DBL - Elcio</option>
                                            <option value="2">DAJ - Geraldo</option>
                                            <option value="3">FEJ - Rodelmar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Data Cadastro</label>
                                    <div class="col-sm-10">
                                        <input type="date" required name="data_cadastro" class="form-control" placeholder="Data Cadastro">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Descrição</label>
                                    <div class="col-sm-10">
                                        <input type="text" required name="descricao" class="form-control" placeholder="Boleto Pneu">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Valor</label>
                                    <div class="col-sm-10">
                                        <input type="text" required name="valor" class="form-control" placeholder="Valor $0,00">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">OBS</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="5" name="obs" class="form-control" placeholder=""></textarea>
                                    </div>
                                </div>
                                <button type="submit" style="position:relative; margin-left: 200px" class="btn btn-info btn-round">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<!-- CHAMANDO O MASKEDINPUT.JS -->
<script type="text/javascript" src="https://raw.github.com/digitalBush/jquery.maskedinput/1.3.1/dist/jquery.maskedinput.js"></script>

<?php include 'view/final_form.php'; ?>