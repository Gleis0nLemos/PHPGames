<?php

function play() {
    echo '<h3>******************************</h3>';
    echo '<h3>Bem vindo ao jogo de adivinhação!</h3>';
    echo '<h3>******************************</h3>';

    echo '<h4>Qual o nível de dificuldade você quer?</h4>';
    echo '<h3>(1)Fácil, (2)Médio, (3)Difícil</h3>';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $secretNumber = rand($min=1, $max=100);
        $attempts = 0;
        $points = 1000;
        
        $dificuldade = $_POST['dificuldade'];
        echo "<h4>Você escolheu: $dificuldade</h4>";

        if ($dificuldade == 1);
            echo 'Você está jogando no fácil';
    } else {
        echo ' 
        <form action="index.php" method="post">
            <label for="dificuldade">Escolha a dificuldade</label>
            <input type="text" name="dificuldade" id="dificuldade">
            <input type="submit" value="Enviar">
        </form>';
    }
}
