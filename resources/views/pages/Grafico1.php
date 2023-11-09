<?php

// requisição da classe PHPlot
require '../../../vendor/autoload.php';

// Instanciar o gráfico com tamanho pré-definido
$objCandidatos = new App\Models\Candidatos();

$data = [];
foreach ($objCandidatos->Buscargrafico1() as $ver) {
    $data[] = [$ver['SEXO'], $ver['QUANT']];
}
#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(470,163);
#Tipo de borda, consulte a documentacao
$plot->SetImageBorderType('plain');
#Por ser: lines, bars, 'boxes', 'bubbles', 'candelesticks', 'candelesticks2', linepoints, 'ohlc', pie, points, squared, stackedarea, stackedbars, thinbarline
$plot->SetPlotType('pie');
// Tipo de dados, nesse caso texto que esta no array
$plot->SetDataType('text-data-single');
// cores do grafico
$plot->SetDataColors(['#2e86de', '#ee55fc', '#3Cf990']);
$plot->SetPieLabelType('label');
// $plot->SetYDataLabelPos('plotin');
// $plot->SetBackgroundColor('white');
// #$plot->SetDataType('data-data-xyz');
// #Setando os valores com os dados do array
$plot->SetDataValues($data);
// Titulo do grafico
$plot->SetTitleColor('#1C1C1C');
$plot->SetTitle('Cadastro Por Generos');
$plot->SetLegend(['Masculino', 'Feminino', 'Outros']);
// Legenda, nesse caso serao tres pq o array possui 3 valores que serao apresentados
// $plot->SetLegend('Vendas Mensais');
// Gera o grafico na tela
$plot->DrawGraph();
