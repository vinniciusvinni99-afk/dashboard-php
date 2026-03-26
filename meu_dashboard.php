<?php

function formatarMoeda($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
}

function analisarDesempenho($vendaItem, $faturamentoTotal) {
    if ($faturamentoTotal == 0) return "Sem dados";

    $percentual = ($vendaItem / $faturamentoTotal) * 100;

    if ($percentual < 10) {
        return "ALERTA: Baixa Conversão";
    } else {
        return "Produto Estrela";
    }
}

function gerarCardHTML($nome, $preco, $mensagemBI) {

    $nomeSeguro = htmlspecialchars($nome);

    $cor = ($mensagemBI == "Produto Estrela") ? "#28a745" : "#dc3545";

    return "
    <div style='
        width: 320px;
        padding: 20px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
        text-align: center;
    '>
        <h2 style='margin-bottom:10px;'>{$nomeSeguro}</h2>

        <p style='font-size:18px; color:#555;'>
            Preço: <strong>{$preco}</strong>
        </p>

        <p style='
            margin-top:15px;
            padding:10px;
            border-radius:8px;
            color:white;
            background: {$cor};
            font-weight:bold;
        '>
            {$mensagemBI}
        </p>
    </div>
    ";
}

$nome = "Hambúrguer Artesanal";
$preco = 29.9;
$vendaItem = 200;
$faturamentoTotal = 3000;

$precoFormatado = formatarMoeda($preco);
$status = analisarDesempenho($vendaItem, $faturamentoTotal);

echo "<body style='
    background:#f0f2f5;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
'>";

echo gerarCardHTML($nome, $precoFormatado, $status);

echo "</body>";

?>