<?php
session_start();
$lig = new mysqli("localhost", "rafael40112", "Psi32425", "rafael40112") or
    die("Problema na ligação ao servidor e base de dados MYSQL");

$e   = $_REQUEST['email'];
$n   = $_REQUEST['nome'];
$id  = $_REQUEST['id'];

$sql = "SELECT e.*, p.titulo, p.foto_prod, f.Nome as fatura_nome, f.Telefone as fatura_telefone, f.Morada as fatura_morada, f.CPostal as fatura_cpostal, f.NIF as fatura_nif
        FROM encomendas e
        LEFT JOIN Produtos p ON e.id_prod = p.id_prod
        LEFT JOIN fatura f ON e.id_encomenda = f.id_encomenda
        WHERE e.id_prod = '$id'
        ORDER BY e.data_compra DESC";
$res = $lig->query($sql);
$lin = $res->fetch_assoc();

if (!$lin) {
    die("Encomenda não encontrada.");
}

// Realiza os cálculos financeiros SEM IVA e portes fixos a 5€
$subtotal = $lin['preco'];
$iva_percentagem = 0; // IVA removido, percentagem a 0
$iva_valor = 0; // IVA removido, valor a 0
$portes = 5; // Portes fixos a 5€
$total_final = round($subtotal + $iva_valor + $portes, 2);

require_once('tcpdf/tcpdf.php');

// Classe customizada para cabeçalho e rodapé
class MYPDF extends TCPDF {
    // Cabeçalho
    public function Header() {
        // Fundo do cabeçalho
        $this->SetFillColor(240,240,240);
        $this->Rect(0, 0, $this->getPageWidth(), 40, 'F');
        // Logo da empresa
        $this->Image('logo.png', 15, 5, 30);
        // Nome da empresa
        $this->SetFont('helvetica', 'B', 20);
        $this->SetTextColor(51,51,51);
        $this->SetXY(50, 15);
        $this->Cell(100, 10, 'ReVibe', 0, 0, 'L');
        // Detalhes da empresa
        $this->SetFont('helvetica', '', 9);
        $this->SetXY(50, 25);
        $this->Cell(100, 5, '', 0, 1, 'L');
    }
    // Rodapé
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica','I',8);
        $this->Cell(0,10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Inicializa o PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator('ReVibe');
$pdf->SetAuthor('ReVibe');
$pdf->SetTitle('Fatura de Encomenda #' . $lin['id_encomenda']);
$pdf->SetMargins(15, 45, 15);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(15);
$pdf->AddPage();

// Caixa de detalhes da fatura (lado direito)
$pdf->SetFillColor(245,245,245);
$pdf->SetFont('helvetica','B',14);
$pdf->Cell(180,10, 'FATURA', 0, 1, 'R');
$pdf->SetFont('helvetica','',10);
$pdf->Cell(180,6, 'Nº: ' . str_pad($lin['id_encomenda'], 6, '0', STR_PAD_LEFT), 0, 1, 'R');
$pdf->Cell(180,6, 'Data: ' . date("d/m/Y", strtotime($lin['data_compra'])), 0, 1, 'R');

$pdf->Ln(10);

// Informações da fatura e do cliente (2 colunas)
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(90,8, 'DADOS DA FATURA', 0, 0, 'L'); // Alterado para "DADOS DA FATURA"
$pdf->Cell(90,8, 'FATURAR A:', 0, 1, 'L');

$pdf->SetFont('helvetica','',10);
// Detalhes da fatura (lado esquerdo) -  Agora com dados da fatura
$pdf->MultiCell(90,5,
    "Nome: " . $lin['fatura_nome'] . "\n" .
    "Morada: " . $lin['fatura_morada'] . "\n" .
    "Código Postal: " . $lin['fatura_cpostal'] . "\n" .
    "Telefone: " . $lin['fatura_telefone'] . "\n" .
    "NIF: " . $lin['fatura_nif'],
    0, 'L', 0, 0);
// Detalhes do cliente (lado direito)
$pdf->MultiCell(90,5,
    $n . "\n" .
    $e . "\n" .
    "Cliente",
    0, 'L', 0, 1);

$pdf->Ln(10);

// Tabela com os detalhes da encomenda
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(180,10, 'DETALHES DA ENCOMENDA', 0, 1, 'L');

// Cabeçalho da tabela
$pdf->SetFillColor(51,51,51);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(60,8, 'Produto', 1, 0, 'L', true); // Largura reduzida para 60
$pdf->Cell(30,8, 'Preço', 1, 0, 'R', true);
$pdf->Cell(40,8, 'Data da Compra', 1, 0, 'C', true);
$pdf->Cell(50,8, 'Email do Vendedor', 1, 1, 'L', true);


(mb_strimwidth($row['titulo'], 0, 20, '...'));

// Linha com os dados da encomenda
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('helvetica','',10);
$pdf->Cell(60,7, (mb_strimwidth($lin['titulo'], 0, 30, '...')), 1, 0, 'L', false); // Largura reduzida para 60
$pdf->Cell(30,7, number_format($lin['preco'], 2, ',', '.') . ' €', 1, 0, 'R', false);
$pdf->Cell(40,7, date("d/m/Y", strtotime($lin['data_compra'])), 1, 0, 'C', false);
$pdf->Cell(50,7, $lin['email_vendedor'], 1, 1, 'L', false);

$pdf->Ln(5);

// Tabela de totais
$pdf->SetFont('helvetica','',10);
$pdf->Cell(120,6, '', 0, 0);
$pdf->Cell(30,6, 'Subtotal:', 0, 0, 'R');
$pdf->Cell(40,6, number_format($subtotal, 2, ',', '.') . ' €', 0, 1, 'R');

$pdf->Cell(120,6, '', 0, 0);
$pdf->Cell(30,6, 'Portes:', 0, 0, 'R');
$pdf->Cell(40,6, number_format($portes, 2, ',', '.') . ' €', 0, 1, 'R');

$pdf->SetFont('helvetica','B',11);
$pdf->Cell(120,8, '', 0, 0);
$pdf->Cell(30,8, 'TOTAL:', 'T', 0, 'R');
$pdf->Cell(40,8, number_format($total_final, 2, ',', '.') . ' €', 'T', 1, 'R');

$pdf->Ln(10);



// Termos e condições
$pdf->Ln(10);
$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(100,100,100);
$pdf->MultiCell(180,5,
    "TERMOS E CONDIÇÕES\n\n" .
    "• Esta fatura serve como comprovativo de compra.\n" .
    "• Prazo para devoluções: 14 dias a partir da data de compra.\n" .
    "• Para suporte, contacte-nos em revibe.geral@gmail.com\n" .
    "• Conserve este documento para efeitos de garantia.",
    0, 'L');


// Exibe o PDF
$pdf->Output('fatura_encomenda.pdf', 'I');
?>