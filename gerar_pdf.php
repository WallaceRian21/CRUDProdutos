<?php
// Carregar o Composer
require 'vendor/autoload.php';
require_once('vendor/TCPDF/examples/tcpdf_include.php');
// Incluir conexao com BD
include_once 'conexao.php';
include_once 'model/Conexao.class.php';
include_once 'model/Manager.class.php';
$manager = new Manager();

if($_SESSION['nome'] == true){
}else {
    session_start();
}
ob_start();

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

date_default_timezone_set('America/Bahia');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Relatorio');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'- 2023', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 15);

// add a page
$pdf->AddPage('L', 'A4');

// test Cell stretching
$pdf->Cell(35, 0, 'Motorista', 1, 0, 'C', 0, '', 0);
$pdf->Cell(35, 0, 'Mês', 1, 0, 'C', 0, '', 1);
$pdf->Cell(35, 0, 'Ano', 1, 0, 'C', 0, '', 1);
$pdf->Cell(50, 0, 'Data e Hora Impressão', 1, 1, 'C', 0, '', 1);
$pdf->Cell(35, 0, ucfirst($_SESSION['nome']), 1, 0, 'C', 0, '', 0);
$pdf->Cell(35, 0, $mes, 1, 0, 'C', 0, '', 1);
$pdf->Cell(35, 0, $nome, 1, 0, 'C', 0, '', 1);
$pdf->Cell(50, 0, date('d/m/Y H:i'), 1, 0, 'C', 0, '', 1);
$pdf->Ln(10);
$pdf->Cell(55, 0, 'Origem', 1, 0, 'L', 0, '', 0);
$pdf->Cell(55, 0, 'Destino', 1, 0, 'L', 0, '', 0);
$pdf->Cell(55, 0, 'Transportadora', 1, 0, 'L', 0, '', 0);
$pdf->Cell(26, 0, 'Valor Frete', 1, 0, 'L', 0, '', 0);
$pdf->Cell(30, 0, 'Disel', 1, 0, 'L', 0, '', 0);
$pdf->Cell(25, 0, 'Pedágio', 1, 0, 'L', 0, '', 0);
$pdf->Cell(22, 0, 'Descarga', 1, 1, 'L', 0, '', 0);
foreach($manager->listViagensMes('viagens', $mes, $id) as $viagens) {
    $pdf->Cell(55, 0, $viagens['origem'], 1, 0, 'L', 0, '', 0);
    $pdf->Cell(55, 0, $viagens['destino'], 1, 0, 'L', 0, '', 0);
    $pdf->Cell(55, 0, $viagens['transportadora'], 1, 0, 'L', 0, '', 0);
    $pdf->Cell(26, 0, number_format($viagens['valor_frete'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, number_format($viagens['gasto_combustivel'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
    $pdf->Cell(25, 0, number_format($viagens['gasto_pedagio'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
    $pdf->Cell(22, 0, number_format($viagens['descarga'], 2, ',', '.'), 1, 1, 'L', 0, '', 0);
}
$pdf->Ln(6);
$pdf->Cell(45, 0, 'Frete Bruto', 1, 0, 'L', 0, '', 0);
$pdf->Cell(45, 0, 'Gasto Combústivel', 1, 0, 'L', 0, '', 0);
$pdf->Cell(35, 0, 'Gasto Pedágio', 1, 0, 'L', 0, '', 0);
$pdf->Cell(36, 0, 'Gasto Descarga', 1, 0, 'L', 0, '', 0);
$pdf->Cell(42, 0, 'Total livre', 1, 1, 'L', 0, '', 0);
$pdf->Cell(45, 0, number_format($totalMesAtual['total'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
$pdf->Cell(45, 0, number_format($totalCombustivel['total'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
$pdf->Cell(35, 0, number_format($totalPedagio['total'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
$pdf->Cell(36, 0, number_format($Totaldescarga['total'], 2, ',', '.'), 1, 0, 'L', 0, '', 0);
$pdf->Cell(42, 0, number_format($totalDespesas['total'], 2, ',', '.'), 1, 1, 'L', 0, '', 0);

//Close and output PDF document
$pdf->Output('Relatorio_viagens.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
