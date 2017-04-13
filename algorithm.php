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
function is_fibonacci()
{
    $input_number = $_POST["inputNumber"];
    $is_belong = false;
    $variable1 = 1;
    $variable2 = 1;
    $count = 0;
    do {
        if ($variable1 > $input_number) {
            return array($is_belong, $input_number, $variable1, $variable2, $count);
        } else {
            if ($variable1 == $input_number) {
                $is_belong = true;
                return array($is_belong, $input_number, $variable1, $variable2, $count);
            } else {
                $variable3 = $variable1;
                $variable1 = $variable1 + $variable2;
                $variable2 = $variable3;
                $count++;
            }
        }
    } while ($variable1 < $input_number || $variable1 != $input_number);
    $is_belong = true;
    return array($is_belong, $input_number, $variable1, $variable2, $count);
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
            $is_ok = null;
            if (isset($_POST["inputNumber"])) {
                list ($is_belong, $input_number, $variable_1, $variable_2, $count) = is_fibonacci();
                if ($is_belong == true) {
                    $is_ok = "ВХОДИТ";
                }
                else if ($is_belong == false){
                    $is_ok = "НЕ ВХОДИТ";
                }
            } else {
                $is_ok = "ПУСТАЯ СТРОКА";
                return;
            }
            echo "<fieldset class=\"$fieldsetClass\">
             Задуманное число <span class=\"answer-text-color\">$is_ok</span> в числовой ряд! </fieldset>
                    <br>Введенное значение: $input_number
                    <br>Значение переменной 1: $variable_1 (текущее значение ряда ФИБОНАЧЧИ)
                    <br>Значение переменной 2: $variable_2 (предыдущее значение ряда ФИБОНАЧЧИ)
                    <br>Повторений цикла: $count ";
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
