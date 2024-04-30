<?php

date_default_timezone_set('America/Bahia');
include_once 'verificalogin.php';
include_once 'log.php';

if ($_SESSION['id'] == true) {
} else {
    session_start();
}

ob_start();

$user = $_SESSION['nome'];
$pagina = "Inserir Viagens";
$data = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

logAcessso($user, $pagina, $data, $ip);

include_once 'view/head.php';
include_once 'view/layout_lateral.php';
date_default_timezone_set('America/Bahia');
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
                        <form method="POST" action="controller/insert_client.php">
                            <div class="card-block">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Origem</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="origem" class="form-control" placeholder="Origem">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Destino</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="destino" class="form-control" placeholder="Destino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Transportadora</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="transportadora" class="form-control" placeholder="Transportadora">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Número da Nota</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="numero_nota" class="form-control" placeholder="Número da Nota">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Valor do Frete</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="valor_frete" id="money" class="form-control" placeholder="Valor do Frete">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Gasto Combustível</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="gasto_combustivel" class="form-control" placeholder="Gasto Combustível">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Gasto Pedágio</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="gasto_pedagio" class="form-control" placeholder="Gasto Pedágio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Descarga</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="descarga" class="form-control" placeholder="Descarga">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Total Lucro</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="total_lucro" class="form-control" placeholder="Total Lucro">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Pagamento</label>
                                    <div class="col-sm-10">
                                        <select name="status_pagamento" class="form-control">
                                            <option value="">Selecione o Status</option>
                                            <option value="Adiantamento">Adiantamento</option>
                                            <option value="Pendente">Pendente</option>
                                            <option value="Pago">Pago</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Data Cadastro</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="data_cadastro" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">OBS</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" cols="5" name="observacao" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KM Inicial</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="km_inicial" class="form-control" placeholder="KM Inicial">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KM Final</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="km_final" class="form-control" placeholder="KM Final">
                                        <input type="hidden" name="motorista_id" value="<?=$_SESSION['id']?>">
                                    </div>
                                </div>
                                <button type="submit" style="position:relative; margin-left: 200px" onclick="return confirm('Você tem certeza que deseja adicionar esse registro ?');" class="btn btn-info btn-round">Salvar</button>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<!-- CHAMANDO O MASKEDINPUT.JS -->
<script type="text/javascript" src="https://raw.github.com/digitalBush/jquery.maskedinput/1.3.1/dist/jquery.maskedinput.js"></script>
<!-- CHAMANDO O MASKMONEY.JS | CASO NÃO VÁ FORMATAR VALORES (R$) RETIRE ESSE PLUGIN -->
<script type="text/javascript" src="https://raw.githubusercontent.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
<script>
    $(document).ready(function(){
    $('#money').mask('000.000.000.000,00');
});
</script>

<?php include 'view/final_form.php'; ?>