<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Генератор равнобедренного треугольника</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 1.1em;
        }
        .triangle-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <h1 class="display-5 fw-bold text-primary">Генератор равнобедренного треугольника</h1>
        </header>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Введите число N</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="triangleNumber" class="form-label">Количество элементов:</label>
                                <input type="number" class="form-control" id="triangleNumber" name="n" required min="1">
                                <div class="form-text">Введите положительное целое число</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Построить треугольник</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Информация</h5>
                    </div>
                    <div class="card-body">
                        <p>Программа строит равнобедренные треугольники двух типов:</p>
                        <ul>
                            <li><strong>Классический треугольник</strong> - требует треугольное число (1, 3, 6, 10, 15, ...)</li>
                            <li><strong>Треугольник с нечетными строками</strong> - требует квадрат целого числа (1, 4, 9, 16, 25, ...)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="triangle-container">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $n = filter_input(INPUT_POST, 'n', FILTER_VALIDATE_INT);

                        if ($n === false || $n <= 0) {
                            echo '<div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Ошибка!</h4>
                                    <p>Пожалуйста, введите положительное целое число.</p>
                                  </div>';
                        } else {
                            ob_start();
                            include 'isosceles_triangle.php';
                            
                            echo '<div class="card">';
                            echo '<div class="card-header bg-success text-white">';
                            echo '<h5 class="mb-0">Результат для N = ' . $n . '</h5>';
                            echo '</div>';
                            echo '<div class="card-body">';
                            
                            if (canFormIsoscelesTriangle($n)) {
                                echo '<pre>';
                                printIsoscelesTriangle($n);
                                echo '</pre>';
                            } else {
                                echo '<div class="alert alert-warning" role="alert">
                                        Невозможно построить равнобедренный треугольник ровно из ' . $n . ' элементов.
                                      </div>';
                                echo '<p>Попробуйте треугольные числа (1, 3, 6, 10, 15, ...) или квадраты целых чисел (1, 4, 9, 16, 25, ...).</p>';
                            }
                            
                            echo '</div></div>';
                            
                            $output = ob_get_clean();
                            echo $output;
                        }
                    } else {
                        echo '<div class="alert alert-info" role="alert">
                                Введите число N и нажмите "Построить треугольник".
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <!-- Валидация формы -->
    <script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>
</html>
