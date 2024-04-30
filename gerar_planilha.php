<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';

$manager = new Manager();

if($_SESSION['id'] == true) {
}else {
    session_start();
}
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Viagens</title>
    <head>
<body>
<?php
$id = $_SESSION['id'];
$mes = $_GET['mes'];
$nome = $_GET['nome_mes'];
$nome_motorista = $_GET['nome'];

$totalMesAtual = $manager->totalMes('viagens', $mes, 'valor_frete', $id);
$totalPedagio = $manager->totalMes('viagens', $mes, 'gasto_pedagio', $id);
$Totaldescarga = $manager->totalMes('viagens', $mes, 'descarga', $id);
$Totallucro = $manager->totalMes('viagens', $mes, 'total_lucro', $id);
$totalCombustivel = $manager->totalMes('viagens', $mes, 'gasto_combustivel', $id);
$totalDespesas = $manager->totalDespesas('viagens', $mes, $id);

date_default_timezone_set('America/Sao_Paulo');
// Definimos o nome do arquivo que será exportado
        $arquivo = 'relatorioviagens_'.$nome.''.date('d/m/Y H:i:s').'.xls';
        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="5">Planilha Relatorios Viagens  '.$nome.'  '.$mes.'  '.$nome_motorista.'</td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>#</b></td>';
        $html .= '<td><b>Origem</b></td>';
        $html .= '<td><b>Destino</b></td>';
        $html .= '<td><b>Transportadora</b></td>';
        $html .= '<td><b>Número Nota</b></td>';
        $html .= '<td><b>Valor Frete</b></td>';
        $html .= '<td><b>Gasto Combustivel</b></td>';
        $html .= '<td><b>Gasto Pedágio</b></td>';
        $html .= '<td><b>Descarga</b></td>';
        $html .= '<td><b>Total Lucro</b></td>';
        $html .= '<td><b>Status Pagamento</b></td>';
        $html .= '<td><b>Data Cadastro</b></td>';
        $html .= '<td><b>Observação</b></td>';
        $html .= '<td><b>Km Inicial</b></td>';
        $html .= '<td><b>Km Final</b></td>';
        $html .= '</tr>';
         
        foreach ($manager->listViagensMes('viagens', $mes, $id) as $client) {

            $html .= '<tr>';
            $html .= '<td><b>' . $client['id'] . '</b></td>';
            $html .= '<td><b>' . $client['origem'] . '</b></td>';
            $html .= '<td><b>' . $client['destino'] . '</b></td>';
            $html .= '<td><b>' . $client['transportadora'] . '</b></td>';
            $html .= '<td><b>' . $client['numero_nota'] . '</b></td>';
            $html .= '<td><b>' . number_format($client['valor_frete'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . number_format($client['gasto_pedagio'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . number_format($client['gasto_combustivel'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . number_format($client['descarga'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . number_format($client['total_lucro'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . $client['status_pagamento'] . '</b></td>';
            $html .= '<td><b>'.date('d/m/Y', strtotime($client['data_cadastro'])). '</b></td>';
            $html .= '<td><b>' . $client['observacao'] . '</b></td>';
            $html .= '<td><b>' . $client['km_inicial'] . '</b></td>';
            $html .= '<td><b>' . $client['km_final'] . '</b></td>';
            $html .= '</tr>';
        }

        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="1">Frete bruto Total mês atual</td>';
        $html .= '<td colspan="1">Total Combústivel</td>';
        $html .= '<td colspan="1">Total Pedágio</td>';
        $html .= '<td colspan="1">Total Descarga</td>';
        $html .= '<td colspan="1">Total Lucro</td>';
        $html .= '<td colspan="1">Total Livre</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= "<th>".number_format($totalMesAtual['total'], 2, ',', '.');"</th>";
        $html .= "<th>".number_format($totalCombustivel['total'], 2, ',', '.');"</th>";
        $html .= "<th>".number_format($totalPedagio['total'], 2, ',', '.');"</th>";
        $html .= "<th>".number_format($Totaldescarga['total'], 2, ',', '.');"</th>";
        $html .= "<th>".number_format($Totallucro['total'], 2, ',', '.');"</th>";
        $html .= "<th>".number_format($totalDespesas['total'], 2, ',', '.');"</th>";
        $html .= '</tr>';
        $html .= '</table>';

$html .= '</table>';

// Configurações header para forçar o download
header("Expires: Mon, 07 Jul 2016 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");
// Envia o conteúdo do arquivo
echo $html;
exit; ?>
</body>
</html>