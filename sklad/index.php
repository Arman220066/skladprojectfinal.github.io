<?php
$imagePath = 'images/background.jpg';
$imagePath1 = 'images/111.jpg';
$imagePath2 = 'images/222.jpg';
$imagePath3 = 'images/333.jpg';
$imagePath4 = 'images/444.jpg';
$imagePath5 = 'images/555.jpg';
$imagePath6 = 'images/666.jpg';
$serviceImage1 = 'images/1.jpg';
$serviceImage2 = 'images/2.jpg';
$serviceImage3 = 'images/3.jpg';
$image1 = 'images/11.jpg';
$image2 = 'images/22.jpg';
$image3 = 'images/33.jpg';
$image4 = 'images/44.jpg';
$image5 = 'images/55.jpg';

$imagePath11 = 'images/123.jpg';
$imagePath22 = 'images/1234.jpg';

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Складская система управления</title>
    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <header class="sticky-top bg-dark text-white py-2">
        <div class="container d-flex justify-content-between">
            <nav>
                <ul class="list-unstyled d-flex mb-0">
                    <li class="me-3"><a class="text-white" href="#functional" >Функционал  </a></li>
                    <li class="me-3"><a class="text-white" href="#advantages" >Преимущества</a></li>
                    <li><a class="text-white" href="#services" >Услуги</a></li>
               </ul>
            </nav>
            <nav>
                <ul class="list-unstyled d-flex mb-0">
                    <li class="me-3"><a class="text-white" href="http://localhost/sklad/login.php">Войти</a></li>
                    <li><a class="text-white" href="http://localhost/sklad/contact.php">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>


    
    <section class="hero text-left py-5" style="background-image: url('<?php echo $imagePath; ?>'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container">
            <div class="overlay">
                <h2 class="display-3 text-white font-weight-bold ">Система для </h2>
                <h2 class="display-3 text-white font-weight-bold ">эффективного управления</h2>
                <h2 class="display-3 text-white font-weight-bold ">складом</h2>
                <p class="lead text-white">Достигните 100% прослеживаемости </p>
                <p class="lead text-white">складских операций</p>
            </div>
        </div>
        <div class="container mt-4">
            <a href="http://localhost/sklad/contact.php" class="fixed-btn btn btn-primary"> Связаться с нами</a>
        </div>
    </section>


    <div class="container mt-5">
        <div class="row">
            <!-- Левый блок с текстом -->
            <div class="col-md-7">
                <h3 class="card-title"><strong>Информация о системе для управления складом</strong></h3>
                <p class="card-text">
                    Наша система управления складом помогает автоматизировать процессы учета, логистики и контроля на вашем складе. 
                    Благодаря автоматизации вы можете значительно улучшить производительность и прозрачность операций.
                </p>
                <h3 class="card-title"><strong>Преимущества системы для управления складом</strong></h3>
                <ul class="list-unstyled card-text">
                    <li>Отслеживание запасов в режиме реального времени и сокращение их дефицита;</li>
                    <li>Оптимизация складских операций;</li>
                    <li>Повышение эффективности и производительности;</li>
                    <li>Эффективное распределение ресурсов и улучшенная пропускная способность;</li>
                </ul>
                <h3 class="card-title"><strong>Откройте для себя новые возможности управления складом с нашей системой!</strong></h3>

                <!-- Кнопка перехода на демо-версию -->
                <a href="http://localhost/sklad/demo.php" class="btn btn-primary demo-btn">Демо-версия</a>
            </div>

            <!-- Правый блок с фото и кнопками -->
            <div class="col-md-5">
                <div class="photo-slider">
                    <div class="photo-slide active">
                        <img src="<?php echo $image1; ?>" class="card-img-top" alt="..." >
                    </div>
                    <div class="photo-slide">
                        <img src="<?php echo $image2; ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="photo-slide">
                        <img src="<?php echo $image3; ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="photo-slide">
                        <img src="<?php echo $image4; ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="photo-slide">
                        <img src="<?php echo $image5; ?>" class="card-img-top" alt="...">
                    </div>                                        
                    <!-- Кнопки для перелистывания -->
                    <button class="photo-slider-btn prev">❮</button>
                    <button class="photo-slider-btn next">❯</button>
                </div>
            </div>
        </div>
    </div>


    <section id="team" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Наша команда</h2>
            <div class="row">


                <div class="col-md-6 mb-4">
                    <div class="card d-flex flex-row align-items-center">
                        <!-- Левая половина: Информация -->
                        <div class="card-body w-50">
                            <h5 class="card-title">Кенжетай Арман</h5>
                            <p class="card-text">Специалист по поддержке клиентов, обеспечивает стабильность и адаптацию системы под бизнес-процессы.</p>
                            <p class="card-text">Специальность: Digital Management and Design</p>
                            <p class="card-text">Корпоративная почта: arman.kenzhetai@narxoz.kz</p>
                            
                        </div>
                        <!-- Правая половина: Фото -->
                        <div class="card-img-right w-50">
                            <img src="<?php echo $imagePath11; ?>" class="img-fluid" alt="..." style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>




    <section id="functional" class="py-5">
        <div class="container text-center">
            <h2>Функционал</h2>
            <p class="lead">Как наша система повышает эффективность складских операций</p>
            <div class="row mt-4">
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                        <div class="card-body"><h4>Запрос с сортировкой</h4></div>
                        <div class="card-body">Отображение отсортированного списка данных.</div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                        
                        <div class="card-body"><h4>Запрос на выборку</h4></div>
                        <div class="card-body">Отображение данных из таблицы.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                    
                        <div class="card-body"><h4>Запрос на выборку с параметром</h4></div>
                        <div class="card-body">Фильтрация данных по пользовательскому вводу.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                        
                        <div class="card-body"><h4>Запрос с вычисляемыми полями</h4></div>
                        <div class="card-body">Вычисление агрегированных значений, например, суммы или среднего.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                
                        <div class="card-body"><h4>Запрос с итогами</h4></div>
                        <div class="card-body">Подсчет итогов по группам.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                
                        <div class="card-body"><h4>Перекрестный запрос</h4></div>
                        <div class="card-body">Комбинация данных из нескольких таблиц без явной связи.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                     
                        <div class="card-body"><h4>Запросы на изменение данных</h4></div>
                        <div class="card-body">Вставка, обновление и удаление записей.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                       
                        <div class="card-body"><h4>Поиск</h4></div>
                        <div class="card-body">Поиск данных по ключевому слову.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="advantages" class="py-5 bg-light">
      <div class="container">
         <h2 class="text-center mb-4">Преимущества</h2>
         <p class="lead text-center">Преимущества нашей системы для вашего бизнеса</p>

         <!-- Карточка 1 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath1; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Повышенная точность инвентаризации</h5>
               <p class="card-text">Отслеживание уровня запасов в режиме реального времени, избегая дефицита или избыточности запасов.</p>
            </div>
         </div>

         <!-- Карточка 2 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath2; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Повышенная производительность</h5>
               <p class="card-text">За счет оптимизации складских процессов, оптимизированного распределения ресурсов и улучшенного управления персоналом.</p>
            </div>
         </div>

         <!-- Карточка 3 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath3; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Повышенная прозрачность склада</h5>
               <p class="card-text">Всестороннее понимание складских операций позволяет принимать упреждающие решения и эффективно выполнять заказы.</p>
            </div>
         </div>

         <!-- Карточка 4 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath4; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Оптимизированное использование ресурсов</h5>
               <p class="card-text">Эффективное использование складских помещений, оборудования и рабочей силы помогают снизить эксплуатационные расходы.</p>
            </div>
         </div>

         <!-- Карточка 5 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath5; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Сокращение числа ошибок</h5>
               <p class="card-text">Уменьшение количества ошибок при комплектации, доставке и выставлении счетов приводит к повышению удовлетворенности клиентов.</p>
            </div>
         </div>

         <!-- Карточка 6 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath6; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Сокращенные сроки выполнения заказа</h5>
               <p class="card-text">Оптимизированные процессы обеспечивают более быструю обработку заказов и сокращение времени выполнения заказов.</p>
            </div>
         </div>
      </div>
   </section>


    <section id="services" class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2>Услуги</h2>
            <p class="lead">Как наша система помогает компаниям достигать этих преимуществ</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark">
                        <img src="<?php echo $serviceImage1; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Поддержка</h5>
                            <p class="card-text">Благодаря профессиональной поддержке 24/7 со стороны нашей команды вы получаете стабильную работу SAP EWM и оперативное устранение проблем.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark">
                        <img src="<?php echo $serviceImage2; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Внедрение</h5>
                            <p class="card-text">Наша команда поможет внедрить решение, а также настроить и наладить его работу в соответствии с бизнес-процессами вашей компании.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark">
                        <img src="<?php echo $serviceImage3; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Управление приложениями</h5>
                            <p class="card-text">Мы поможем извлечь максимум из системы благодаря постоянным улучшениям и доработкам решения, а также мониторингу его производительности и адаптации к потребностям вашего бизнеса.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Кнопка прокрутки наверх -->
    <button id="scrollToTop" class="btn btn-primary">На верх</button>
    <!-- Кнопка "EN" -->
    <button id="language-button" onclick="window.location.href='http://localhost/sklad/111.php'">EN</button>




    

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2024 Складская система управления. Все права защищены.</p>
        <p>Администрация: Narxoz University</p>
    </footer>










    <script src="js/script.js"></script>
</body>
</html>
