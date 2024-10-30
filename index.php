
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor</title>
    <style>
        body{background-color: gainsboro};
    </style>
</head>
<body>
    <h1>Conversor de Dólar</h1>
    

    <form method="post">

    <label for="numero"></label>
    <input type="number" name="numero" id="idnumero"> 

    <input type="submit" value="Enviar">

    </form>
    <br>
    Resultado:  
    <?php 

$inicio = date("m-d-Y", strtotime("-7 days"));
$fim = date("m-d-Y");

$url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''.$fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra';

$dados = json_decode(file_get_contents($url), true);

//var_dump($dados);

//$converçao = ["value"][0]["cotacaoCompra"];

$cotacao = $dados['value'][0]['cotacaoCompra'];


// se tiver request:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //recolhe os input
    $number = $_POST['numero'] ?? 0;

    //$dollar = $number * 5.76;
    $real = $number/$cotacao;
    $realf = round($real, 2);

    //echo "US\$$number dolares são $dollar Reais <br>";
    echo "RS\$ " . number_format($number, 2, "," , ".") . " Reais são <strong>US\$" . $realf."</strong>"; 
    
    
}  
print"/Cotação do dia <strong>US\$ ". number_format($cotacao, 2, ",", "."); 
?>

</body>
</html>