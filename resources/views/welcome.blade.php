<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/image/icon.png" type="image/png" sizes="16x16">

    <title>WorldEye</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col">
                <span class="d-flex m-0 p-0">
                    <img  src="/image/logo.png" width="100px" height="70px">
                    <h1 class="mt-3 mb-5 text-secondary">World<b class="text-danger">E</b>ye</h1>
                </span>
                <h2 class="mb-4">Welcome</h2>
                <p>Do you want a place to save photos or share photos with a large network?</p>
                <p>We are the <b>WorldEye family</b>, offer you a place to save images with the feature of sharing them over a wide network from different parts of the world, in addition to displaying high-quality images and many features that distinguish our site from any other site.</p>
            </div>
            <div class="col-md-7 col-sm-12 mt-5">
                <!--Carousel Wrapper-->
                <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

                    <!--Indicators-->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                    </ol>
                    <!--/.Indicators-->

                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                        <!--First slide-->
                        <div class="carousel-item active w-100">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100" alt="Cliff Above a Stormy Sea" />
                        </div>
                        <!--/First slide-->

                        <!--Second slide-->
                        <div class="carousel-item w-100">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100" alt="Canyon at Nigh" />
                        </div>
                        <!--/Second slide-->

                        <!--Third slide-->
                        <div class="carousel-item w-100">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100" alt="Sunset Over the City" />
                        </div>
                        <!--/Third slide-->
                    </div>
                    <!--/.Slides-->

                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev"></a>
                    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next"></a>
                    <!--/.Controls-->

                </div>
                <!--/.Carousel Wrapper-->
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5 text-center text-sm-left ">
                <a class="btn btn-primary text-decoration-none w-50 mt-3" href="/login" role="button"> Enter </a>
            </div>
        </div>
    </div>
    <footer class="bg-light fixed-bottom p-2">
        <div class="text-center">
            Designed by WorldEye Team.
            <a class="text-decoration-none" target="_blank" href="https://www.facebook.com/worldeye547">
                <i class="fa fa-facebook-square fa-lg"></i>
            </a>
            <a class="text-decoration-none" target="_blank" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&to=worldeye547@gmail.com">
                <i class="fa fa-envelope-square fa-lg"></i>
            </a>
        </div>
    </footer>
</body>

</html>
