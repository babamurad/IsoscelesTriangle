<?php

function printIsoscelesTriangle(int $n): void
{
    // if ($n < 3) {
    //     echo "Ошибка: Невозможно построить треугольник из менее чем 3 элементов.\n";
    //     return;
    // }
    
    // Проверяем, можно ли построить треугольник с нечетным числом элементов в строках
    $k = (int)sqrt($n);
    if ($k * $k == $n) {
        // Квадратное число - можно построить треугольник с нечетными строками
        printOddRowsTriangle($n, $k);
        return;
    }
    
    // Проверяем, можно ли построить треугольник с последовательным увеличением на 1
    $k = (int)((-1 + sqrt(1 + 8 * $n)) / 2);
    if ($k * ($k + 1) / 2 == $n) {
        // Треугольное число - можно построить классический треугольник
        printClassicTriangle($n, $k);
        return;
    }
    
    echo "Ошибка: Невозможно построить треугольник ровно из {$n} элементов.\n";
}

function printOddRowsTriangle(int $n, int $rows): void
{
    $num = 1;
    
    for ($i = 1; $i <= $rows; $i++) {
        // Количество элементов в текущей строке (1, 3, 5, 7, ...)
        $elementsInRow = 2 * $i - 1;
        
        // Добавляем отступы для выравнивания
        $padding = str_repeat(' ', ($rows - $i) * 3);
        echo $padding;
        
        // Выводим числа в текущей строке
        for ($j = 1; $j <= $elementsInRow; $j++) {
            echo $num . ' ';
            $num++;
        }
        echo "\n";
    }
}

function printClassicTriangle(int $n, int $rows): void
{
    $num = 1;
    
    for ($i = 1; $i <= $rows; $i++) {
        // Добавляем отступы для выравнивания
        $padding = str_repeat(' ', ($rows - $i) * 3);
        echo $padding;
        
        // Выводим числа в текущей строке
        for ($j = 1; $j <= $i; $j++) {
            echo $num . ' ';
            $num++;
        }
        echo "\n";
    }
}

function canFormIsoscelesTriangle(int $n): bool
{
    if ($n < 3) {
        return false;
    }
    
    // Проверяем, является ли n квадратом целого числа (для треугольника с нечетными строками)
    $sqrtN = sqrt($n);
    if (floor($sqrtN) == $sqrtN) {
        return true;
    }
    
    // Проверяем, является ли n треугольным числом (для классического треугольника)
    $discriminant = 1 + 8 * $n;
    $sqrtDiscriminant = sqrt($discriminant);
    
    return is_int($sqrtDiscriminant) || (floor($sqrtDiscriminant) == $sqrtDiscriminant && 
           (-1 + $sqrtDiscriminant) % 2 == 0);
}

// Обработка аргументов командной строки
if (php_sapi_name() === 'cli') {
    // Код выполняется из командной строки
    if (!isset($argc) || $argc !== 2) {
        echo "Использование: php isosceles_triangle.php <N>\n";
        exit(1);
    }

    $n = filter_var($argv[1], FILTER_VALIDATE_INT);

    if ($n === false || $n <= 0) {
        echo "Ошибка: N должно быть положительным целым числом.\n";
        exit(1);
    }

    if (canFormIsoscelesTriangle($n)) {
        printIsoscelesTriangle($n);
    } else {
        echo "Ошибка: Невозможно построить равнобедренный треугольник из {$n} элементов.\n";
    }
}

?>
