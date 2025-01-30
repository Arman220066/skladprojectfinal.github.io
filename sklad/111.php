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
    <title>Warehouse management system</title>
    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <header class="sticky-top bg-dark text-white py-2">
        <div class="container d-flex justify-content-between">
            <nav>
                <ul class="list-unstyled d-flex mb-0">
                    <li class="me-3"><a class="text-white" href="#functional" >Functional  </a></li>
                    <li class="me-3"><a class="text-white" href="#advantages" >Advantages</a></li>
                    <li><a class="text-white" href="#services" >Services</a></li>
               </ul>
            </nav>
            <nav>
                <ul class="list-unstyled d-flex mb-0">
                    <li class="me-3"><a class="text-white" href="http://localhost/sklad/111login.php">Login</a></li>
                    <li><a class="text-white" href="http://localhost/sklad/111contact.php">Contacts</a></li>
                </ul>
            </nav>
        </div>
    </header>


    
    <section class="hero text-left py-5" style="background-image: url('<?php echo $imagePath; ?>'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container">
            <div class="overlay">
                <h2 class="display-3 text-white font-weight-bold ">A system for </h2>
                <h2 class="display-3 text-white font-weight-bold ">effective warehouse </h2>
                <h2 class="display-3 text-white font-weight-bold ">management</h2>
                <p class="lead text-white">Achieve 100% traceability </p>
                <p class="lead text-white">warehouse operations</p>
            </div>
        </div>
        <div class="container mt-4">
            <a href="http://localhost/sklad/111contact.php" class="fixed-btn btn btn-primary">Contact us</a>
        </div>
    </section>


    <div class="container mt-5">
        <div class="row">
            <!-- Левый блок с текстом -->
            <div class="col-md-7">
                <h3 class="card-title"><strong>Information about the warehouse management system</strong></h3>
                <p class="card-text">
                    Our warehouse management system helps automate accounting, logistics, and control processes in your warehouse. 
                    With automation, you can significantly improve the productivity and transparency of operations.
                </p>
                <h3 class="card-title"><strong>Advantages of a warehouse management system</strong></h3>
                <ul class="list-unstyled card-text">
                    <li>Real-time inventory tracking and deficit reduction;</li>
                    <li>Optimization of warehouse operations;</li>
                    <li>Improving efficiency and productivity;</li>
                    <li>Efficient resource allocation and improved throughput;</li>
                </ul>
                <h3 class="card-title"><strong>Discover new warehouse management features with our system!</strong></h3>

                <!-- Кнопка перехода на демо-версию -->
                <a href="http://localhost/sklad/111demo.php" class="btn btn-primary demo-btn">Demo-version</a>
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
            <h2 class="text-center mb-4">Our team</h2>
            <div class="row">

               <!-- Карточка 1 -->
                <div class="col-md-6 mb-4">
                    <div class="card d-flex flex-row align-items-center">
                        <!-- Левая половина: Информация -->
                        <div class="card-body w-50">
                            <h5 class="card-title">Kenzhetai Arman</h5>
                            <p class="card-text">A customer support specialist, ensures the stability and adaptation of the system to business processes.</p>
                            <p class="card-text">Specialization: Digital Management and Design</p>
                            <p class="card-text">Corporate mail: arman.kenzhetai@narxoz.kz</p>
                            
                        </div>
                        <!-- Правая половина: Фото -->
                        <div class="card-img-right w-50">
                            <img src="<?php echo $imagePath11; ?>" class="img-fluid" alt="..." style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>

                <!-- Карточка 2 -->
                <div class="col-md-6 mb-4">
                    <div class="card d-flex flex-row align-items-center">
                        <!-- Левая половина: Информация -->
                        <div class="card-body w-50">
                            <h5 class="card-title">Akylbek Askhat</h5>
                            <p class="card-text">Head of the development department, specializes in automating warehouse management processes.</p>
                            <p class="card-text">Specialization: Digital Engineering</p>
                            <p class="card-text">Corporate mail: askhat.akylbek@narxoz.kz</p>
                            
                        </div>
                        <!-- Правая половина: Фото -->
                        <div class="card-img-right w-50">
                            <img src="<?php echo $imagePath22; ?>" class="img-fluid" alt="..." style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <section id="functional" class="py-5">
        <div class="container text-center">
            <h2>Functional</h2>
            <p class="lead">How our system improves the efficiency of warehouse operations</p>
            <div class="row mt-4">
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                        <div class="card-body"><h4>Query with sorting</h4></div>
                        <div class="card-body">Displaying a sorted list of data.</div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                        
                        <div class="card-body"><h4>Request for selection</h4></div>
                        <div class="card-body">Displaying data from a table.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                    
                        <div class="card-body"><h4>Request for selection with the parameter</h4></div>
                        <div class="card-body">Filtering data by user input.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                        
                        <div class="card-body"><h4>Query with calculated fields</h4></div>
                        <div class="card-body">Calculating aggregated values, such as the sum or average.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                
                        <div class="card-body"><h4>Request with results</h4></div>
                        <div class="card-body">Calculating totals by groups.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                
                        <div class="card-body"><h4>Cross-query</h4></div>
                        <div class="card-body">A combination of data from several tables without an explicit relationship.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                     
                        <div class="card-body"><h4>Requests for data modification</h4></div>
                        <div class="card-body">Inserting, updating, and deleting records.</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white border-primary">
                       
                        <div class="card-body"><h4>Search</h4></div>
                        <div class="card-body">Search for data by keyword.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="advantages" class="py-5 bg-light">
      <div class="container">
         <h2 class="text-center mb-4">Advantages</h2>
         <p class="lead text-center">Advantages of our system for your business</p>

         <!-- Карточка 1 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath1; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Improved inventory accuracy</h5>
               <p class="card-text">Track inventory levels in real time, avoiding shortages or excess inventory.</p>
            </div>
         </div>

         <!-- Карточка 2 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath2; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Increased productivity</h5>
               <p class="card-text">By optimizing warehouse processes, optimized resource allocation, and improved personnel management.</p>
            </div>
         </div>

         <!-- Карточка 3 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath3; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Increased transparency of the warehouse</h5>
               <p class="card-text">A comprehensive understanding of warehouse operations allows you to make proactive decisions and efficiently fulfill orders.</p>
            </div>
         </div>

         <!-- Карточка 4 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath4; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Optimized resource usage</h5>
               <p class="card-text">Efficient use of storage facilities, equipment, and labor help reduce operating costs.</p>
            </div>
         </div>

         <!-- Карточка 5 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath5; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Reducing the number of errors</h5>
               <p class="card-text">Reducing the number of errors in picking, shipping, and billing leads to increased customer satisfaction.</p>
            </div>
         </div>

         <!-- Карточка 6 -->
         <div class="card mb-4 d-flex flex-row align-items-center">
            <img src="<?php echo $imagePath6; ?>" class="card-img-left" alt="..." style="width: 120px; height: 120px; object-fit: cover;">
            <div class="card-body">
               <h5 class="card-title">Reduced order completion time</h5>
               <p class="card-text">Optimized processes ensure faster order processing and shorter lead times.</p>
            </div>
         </div>
      </div>
   </section>


    <section id="services" class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2>Services</h2>
            <p class="lead">How does our system help companies achieve these benefits?</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark">
                        <img src="<?php echo $serviceImage1; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Support</h5>
                            <p class="card-text">Thanks to the 24/7 professional support from our team, you get stable SAP EWM operation and prompt troubleshooting.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark">
                        <img src="<?php echo $serviceImage2; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Integration</h5>
                            <p class="card-text">Our team will help you implement the solution, as well as configure and adjust its operation in accordance with your company's business processes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark">
                        <img src="<?php echo $serviceImage3; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Application Management</h5>
                            <p class="card-text">We will help you get the most out of the system through continuous improvements and improvements to the solution, as well as monitoring its performance and adapting it to the needs of your business.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Кнопка прокрутки наверх -->
    <button id="scrollToTop" class="btn btn-primary">Up</button>
    <!-- Кнопка "EN" -->
    <button id="language-button" onclick="window.location.href='http://localhost/sklad/index.php'">RUS</button>



    

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2024 Warehouse management system. All rights reserved.</p>
        <p>Administration: Narxoz University</p>
    </footer>










    <script src="js/script.js"></script>
</body>
</html>
