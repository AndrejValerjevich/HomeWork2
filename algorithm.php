<?php
error_reporting(E_ALL);
#region//Определение страницы и задание head и title
if (!empty($_GET["pageType"])) {
    $typeOfPage = $_GET["pageType"];

    if ($typeOfPage == "main") {
        $head = 'Главная' . ' ' . 'страница';
        $fieldsetClass = "main-container-fieldset-main";
    } else
        if ($typeOfPage == "algorithm") {
            $head = "Алгоритм";
            $fieldsetClass = "main-container-fieldset-algorithm";
        }
}
else
{
    $head = "Главная страница";
    $fieldsetClass = "main-container-fieldset-main";
}
$title = "Веб-приложение";
#endregion

#region//Алгоритм для вычисления принадлежности ряда ФИБОНАЧЧИ
function algorithm($ClassForFieldset)
{
    $inputNumber = $_POST["inputNumber"];
    $variable1 = 1;
    $variable2 = 1;
    $variable3 = 0;
    $count = 0;
    do {
        if ($variable1 > $_POST["inputNumber"]) {
            return "<fieldset class=\"$ClassForFieldset\">
             Задуманное число <span class=\"answer-text-color\">НЕ ВХОДИТ</span> в числовой ряд! </fieldset> 
                    <br>Введенное значение: $inputNumber
                    <br>Значение переменной 1: $variable1 (текущее значение ряда ФИБОНАЧЧИ)
                    <br>Значение переменной 2: $variable2 (предыдущее значение ряда ФИБОНАЧЧИ)
                    <br>Повторений цикла: $count";
        } else {
            if ($variable1 == $_POST["inputNumber"]) {
                return "<fieldset class=\"$ClassForFieldset\">
             Задуманное число <span class=\"answer-text-color\">ВХОДИТ</span> в числовой ряд! </fieldset> 
                        <br>Введенное значение: $inputNumber
                        <br>Значение переменной 1: $variable1 (текущее значение ряда ФИБОНАЧЧИ)
                        <br>Значение переменной 2: $variable2 (предыдущее значение ряда ФИБОНАЧЧИ)
                        <br>Повторений цикла: $count";
            } else {
                $variable3 = $variable1;
                $variable1 = $variable1 + $variable2;
                $variable2 = $variable3;
                $count++;
            }
        }
    } while ($variable1 < $_POST["inputNumber"] || $variable1 != $_POST["inputNumber"]);
    return "<fieldset class=\"$ClassForFieldset\">
             Задуманное число <span class=\"answer-text-color\">ВХОДИТ</span> в числовой ряд! </fieldset>
            <br>Введенное значение: $inputNumber
            <br>Значение переменной 1: $variable1 (текущее значение ряда ФИБОНАЧЧИ)
            <br>Значение переменной 2: $variable2 (предыдущее значение ряда ФИБОНАЧЧИ)
            <br>Повторений цикла: $count";
}

#endregion
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
<header class="header-container">
    <div class="header-container__h1">
        <h1 class="header-h1"><?php echo $head; ?></h1>
                <a class="header-container-link" href="algorithm.php?pageType=main">Главная</a>
                <a class="header-container-link" href="algorithm.php?pageType=algorithm">Алгоритм</a>
    </div>
                     
</header>

<div class="main-container">
    <fieldset class="<?php echo $fieldsetClass?>">
        <?php if ($head === "Алгоритм") {
            echo "<form name=\"inputNumber\" method=\"post\" action=\"algorithm.php?pageType=algorithm\">
                     <p><b>Введите число:</b><br><br>
                          <input type=\"text\" name=\"inputNumber\" class=\"inputNumber-form\">
                     </p>
                     <p><input type=\"submit\" value=\"Отправить\">
                        <input type=\"reset\" value=\"Очистить\"></p>
                  </form>";
            if (isset($_POST["inputNumber"])) {
                    echo "<p>" . algorithm($fieldsetClass) . "</p>";
            } else {
                echo "";
            }
        }
        else {
            echo "<h1 class=\"main-container-h1\">Алгоритм проверки числа на принадлежность к числовому ряду!</h1>";
            echo "<h2 class=\"main-container-h2\">Числа ФИБОНАЧЧИ</h2>";
            echo "<p class=\"fieldset-image\"><img src=\"symbol.png\" width=\"120\" height=\"100\"></p>";
        }
        ?>

    </fieldset>
</div>
</body>
</html>
