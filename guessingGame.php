<?php

function play() {
    echo '<h3>******************************</h3>';
    echo '<h3>Bem vindo ao jogo de adivinhação!</h3>';
    echo '<h3>******************************</h3>';

    echo '<h4>Qual o nível de dificuldade você quer?</h4>';
    echo '<h3>(1)Fácil, (2)Médio, (3)Difícil</h3>';
    
    $secretNumber = 2;#rand($min=1, $max=100);
    $attempts = 0;
    $points = 1000;

    if (!isset($_POST['dificuldade'])) {
        echo ' 
        <form action="index.php" method="post">
            <label for="dificuldade">Escolha a dificuldade</label>
            <input type="text" name="dificuldade" id="dificuldade">
            <input type="submit" value="Enviar">
        </form>';
    } else {
        $dificuldade = $_POST['dificuldade'];
        echo "<h4>Você escolheu: $dificuldade</h4>";

        if ($dificuldade == 1) {
            echo '<h4>Você está jogando no fácil</h4>'; 
        } elseif ($dificuldade==2) {
            echo '<h4>Você está jogando no médio</h4>';
        } elseif ($dificuldade==3) {
            echo '<h4>Você está jogando no difícil</h4>';
        } else {
            echo '<h4>Digite uma dificuldade válida</h4>'; 
        }
    }
    
    if (!isset($_POST['chute'])) {
        echo ' 
        <form action="index.php" method="post">
            <label for="chute">Chute um número de 1 a 100</label>
            <input type="text" name="chute" id="chute">
            <input type="submit" value="Enviar">
        </form>';
    } else {
        $chute = $_POST['chute'];
        echo "<h4>Você chutou: $chute</h4>";
    }   
}