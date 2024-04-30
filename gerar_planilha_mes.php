<?php
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';

$manager = new Manager();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Viagens</title>
    <head>
<body>
<?php
// Definimos o nome do arquivo que será exportado
        $arquivo = 'msgcontatos.xls';
        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="5">Planilha Mensagem de Contatos</td>';
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
        $html .= '</tr>';
        foreach ($manager->listViagensMes("viagens_elcio") as $client) {
            $html .= '<tr>';
            $html .= '<td><b>' . $client['id'] . '</b></td>';
            $html .= '<td><b>' . $client['origem'] . '</b></td>';
            $html .= '<td><b>' . $client['destino'] . '</b></td>';
            $html .= '<td><b>' . $client['transportadora'] . '</b></td>';
            $html .= '<td><b>' . $client['numero_nota'] . '</b></td>';
            $html .= '<td><b>' . number_format($client['valor_frete'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . number_format($client['gasto_pedagio'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . number_format($client['gasto_combustivel'], 2, ',', '.') . '</b></td>';
            $html .= '<td><b>' . $client['descarga'] . '</b></td>';
            $html .= '<td><b>' . $client['total_lucro'] . '</b></td>';
            $html .= '<td><b>' . $client['status_pagamento'] . '</b></td>';
            $html .= '<td><b>'.date('d/m/Y', strtotime($client['data_cadastro'])). '</b></td>';
            $html .= '<td><b>' . $client['observacao'] . '</b></td>';
            $html .= '</tr>';
        }
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