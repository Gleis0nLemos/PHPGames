<?php

session_start();

function play() 
{
    echo '<h3>******************************</h3>';
    echo '<h3>Bem vindo ao jogo de adivinhação!</h3>';
    echo '<h3>******************************</h3>';

    if (!isset($_SESSION['secretNumber'])) {
        $_SESSION['secretNumber'] = 2;#rand($min=1, $max=100);
        $_SESSION['attempts'] = 4;
        $_SESSION['mostrouDificuldade'] = false;
        #$points = 1000;
    }

    if (!isset($_POST['dificuldade']) && !$_SESSION['mostrouDificuldade']) {
        echo '<h4>Qual o nível de dificuldade você quer?</h4>';
        echo '<h3>(1)Fácil, (2)Médio, (3)Difícil</h3>';
        echo ' 
        <form action="index.php" method="post">
            <label for="dificuldade">Escolha a dificuldade</label>
            <input type="text" name="dificuldade" id="dificuldade">
            <input type="submit" value="Enviar">
        </form>';
        $_SESSION['mostrouDificuldade'] = true;
        return;
    } else {
        $dificuldade = isset($_POST['dificuldade']) ? (int)$_POST['dificuldade'] : 0;

        if ($dificuldade == 1) {
            echo '<h4>Você está jogando no fácil</h4>'; 
        } elseif ($dificuldade==2) {
            echo '<h4>Você está jogando no médio</h4>';
        } elseif ($dificuldade==3) {
            echo '<h4>Você está jogando no difícil</h4>';
        } elseif (isset($_POST['dificuldade'])) {
            echo '<h4>Digite uma dificuldade válida</h4>'; 
        }
    }

    if (isset($_POST['chute'])) {
    $chute = (int)$_POST['chute'];
    $_SESSION['attempts']--;

        if ($chute == $_SESSION['secretNumber']) {
            echo '<h3>Você acertou!</h3>';
            session_destroy();
        } elseif ($_SESSION['attempts'] == 0) {
            echo '<h4>Fim do jogo! Você não conseguiu adivinhar</h4>';
            echo "<p>O número secreto era: {$_SESSION['secretNumber']}</p>";
            session_destroy();
        } else {
            if ($chute < $_SESSION['secretNumber']) {
                echo '<h4>Um número um pouco maior</h4>';
            } else {
                echo '<h4>Um número um pouco menor</h4>';
            }

            echo "<p>Rest". ($_SESSION['attempts'] > 1 ? "am": "a"). " {$_SESSION['attempts']} tentativa" . ($_SESSION['attempts'] > 1 ? 's' : '')."</p>";
            echo ' 
            <form action="index.php" method="post">
                <label for="chute">Chute um número de 1 a 100</label>
                <input type="text" name="chute" id="chute">
                <input type="submit" value="Enviar">
            </form>';
        } 
    } else {
        echo ' 
        <form action="index.php" method="post">
            <label for="chute">Chute um número de 1 a 100</label>
            <input type="text" name="chute" id="chute">
            <input type="submit" value="Enviar">
        </form>';
    }  
}