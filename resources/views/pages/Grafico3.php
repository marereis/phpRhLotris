<?php
//requisição da classe PHPlot
require '../../../vendor/autoload.php';

// Instanciar o gráfico com tamanho pré-definido
// Deixar em branco faz com que o gráfico encaixe na janela
$objVagas = new App\Models\Vagas();

$data = [];
foreach ($objVagas->buscarGrafico() as $ver) {
    $data[] = [$ver['MES'], $ver['QUANT']];
}
#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(800, 163, NULL, NULL);
#Tipo de borda, consulte a documentacao
$plot->SetImageBorderType('plain');
#Por ser: lines, bars, 'boxes', 'bubbles', 'candelesticks', 'candelesticks2', linepoints, 'ohlc', pie, points, squared, stackedarea, stackedbars, thinbarline
$plot->SetPlotType('linepoints');
#Tipo de dados, nesse caso texto que esta no array
$plot->SetDataType('text-data');
#$plot->SetDataType('data-data-xyz');
#Setando os valores com os dados do array
$plot->SetDataValues($data);
#cores do grafico
$plot->SetDataColors(array('#4484ce'));
$plot->SetYDataLabelPos('plotin');
$plot->SetBackgroundColor('white');
#Titulo do grafico
$plot->SetTitleColor('#1C1C1C');
$plot->SetTitle('Cadastro de Vagas Mensal');
 # Título dos dados no eixo Y
 $plot->SetYTitle("Quantidades ");
 # Título dos dados no eixo X                  
 $plot->SetXTitle("Meses");
#Legenda, nesse caso serao tres pq o array possui 3 valores que serao apresentados
$plot->SetLegend(['Quantidade']);
#Utilizados p/ marcar labels, necessario mas nao se aplica neste ex. (manual) :
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');
$plot->SetYTickLabelPos('none');
$plot->SetYTickPos('none');
#Gera o grafico na tela
$plot->DrawGraph();


