<?php

session_start();


function showMessage ($message) {
    echo '<h4>' .$message. '</h4>';
}
    

function displayForm($label, $name){
    echo ' 
        <form action="index.php" method="post">
            <label for="' .$name. '"> ' .$label. '</label>
            <input type="text" name="' .$name. '" id="' .$name. '">
            <input type="submit" value="Enviar">
        </form>
        <hr>';
}


function play() 
{
    echo '<hr>';
    echo '<h3>Consegue adivinhar?</h3>';
    echo '<hr>';

    if (!isset($_SESSION['secretNumber'])) {
        $_SESSION['secretNumber'] = 2;#rand($min=1, $max=100);
        $_SESSION['attempts'] = 4;
        $_SESSION['mostrouDificuldade'] = false;
        #$points = 1000;
    }

    if (!isset($_POST['dificuldade']) && !$_SESSION['mostrouDificuldade']) {
        showMessage('Qual o nível de dificuldade você quer?');
        echo '<h3>(1)Fácil, (2)Médio, (3)Difícil</h3>';

        displayForm('Escolha uma dificuldade: ', 'dificuldade');

        $_SESSION['mostrouDificuldade'] = true;
        return;
    } else {
        $dificuldade = isset($_POST['dificuldade']) ? (int)$_POST['dificuldade'] : 0;

        if ($dificuldade >=1 && $dificuldade <= 3) {
            showMessage('Você está jogando no '. ["", "fácil", "médio", "difícil"][$dificuldade]);
        } elseif (isset($_POST['dificuldade'])) {
            showMessage('Digite uma dificuldade válida'); 
        }
    }

    if (isset($_POST['chute'])) {
    $chute = (int)$_POST['chute'];
    $_SESSION['attempts']--;

        if ($chute == $_SESSION['secretNumber']) {
            echo '<h3>Você acertou!</h3>';
            showMessage('Fim do jogo! Você ganhou!');
            session_destroy();
        } elseif ($_SESSION['attempts'] == 0) {
            showMessage('Fim do jogo! Você não conseguiu adivinhar');
            echo "<p>O número secreto era: {$_SESSION['secretNumber']}</p>";
            session_destroy();
        } else {
            $message = ($chute < $_SESSION['secretNumber'] ? 'Um número um pouco maior' : 'Um número um pouco maior'); 
            showMessage($message);

            $pluralT = ($_SESSION['attempts'] > 1 ? 's' : '');
            $pluralR = ($_SESSION['attempts'] > 1 ? "am": "a");
            echo "<p>Rest". $pluralR. " {$_SESSION['attempts']} tentativa" . $pluralT."</p>";
            
            displayForm('Chute um número de 1-100: ', 'chute');
        } 
    } else {
        displayForm('Chute um número de 1-100: ', 'chute');
    }
}