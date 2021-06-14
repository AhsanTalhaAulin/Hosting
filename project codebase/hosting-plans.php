<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <title>Harris Web Works Dhaka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/animate.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <script src="./js/modernizr-3.5.0.min.js"></script>
</head>

<body>





    <?php
    session_start();
    // include_once 'header.php';
    // session_start();
    include_once 'index.php#contact-us';

    ?>

    <?php

        class Plans{
            protected $name;
            protected $cost;
            protected $ssd_storage;
            protected $data_transfer;
            protected $addon_domain;

            function __construct($name, $cost, $ssd_storage, $data_transfer, $addon_domain)
            {
                $this->name= $name;
                $this->cost= $cost;
                $this->ssd_storage= $ssd_storage;
                $this->data_transfer= $data_transfer;
                $this->addon_domain= $addon_domain;
            }
        }


    ?>

<?php
$P1 = new Plans("Plan 1", "1500", "2" , "100", "2");
$P2 = new Plans("Plan 1", "1500", "2" , "100", "2");



?>
    <div class="plans">
        <div class="container" id="hosting-plans">

            <div class="heading animate-box">
                <h2><b>CHOOSE YOUR PLAN</b></h2>
            </div>
            <div class="text-center animate-box">
                <h3>Popular plans</h3>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-4 animate-box" data-animate-effect="fadeInLeft">
                    <div class="price-box" id="plan1">
                        <h3><b>PLAN 1</b></h3>
                        <h3><b>1500TK</b><sub>/Year</sub></h3>
                        <div class="gr-line"></div>
                        <div>2 GB SSD Storage</div>
                        <div class="gr-line"></div>
                        <div>100 GB Data Transfer Monthly </div>
                        <div class="gr-line"></div>
                        <div>2 Addon DOMAIN</div>
                        <div class="gr-line"></div>
                        <div>LiteSpeed Web Server</div>
                        <div class="gr-line"></div>
                        <div>cPanel Control Panel</div>
                        <div class="gr-line"></div>
                        <div>FREE SSL Life Time </div>
                        <div class="gr-line"></div>
                        <div>FREE Weekly Backup </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Sub Domains </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Email Accounts </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Databases</div>
                        <div class="gr-line"></div>

                        <br>
                        <button class="btn btn-banner">GET STARTED</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="price-box animate-box">
                        <h3><b>PLAN 2</b></h3>
                        <h3><b>2000TK</b><sub>/Year</sub></h3>
                        <div class="gr-line"></div>
                        <div>3 GB SSD Storage</div>
                        <div class="gr-line"></div>
                        <div>150 GB Data Transfer Monthly</div>
                        <div class="gr-line"></div>
                        <div>3 Addon DOMAIN</div>
                        <div class="gr-line"></div>
                        <div>LiteSpeed Web Server</div>
                        <div class="gr-line"></div>
                        <div>cPanel Control Panel</div>
                        <div class="gr-line"></div>
                        <div>FREE SSL Life Time </div>
                        <div class="gr-line"></div>
                        <div>FREE Weekly Backup </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Sub Domains </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Email Accounts </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Databases</div>
                        <div class="gr-line"></div>
                        <br>
                        <button class="btn btn-banner">GET STARTED</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="price-box animate-box" data-animate-effect="fadeInRight">
                        <h3><b>PLAN 3</b></h3>
                        <h3><b>3000TK</b><sub>/Year</sub></h3>
                        <div class="gr-line"></div>
                        <div>5 GB SSD Storage</div>
                        <div class="gr-line"></div>
                        <div>250 GB Data Transfer Monthly</div>
                        <div class="gr-line"></div>
                        <div>5 Addon DOMAIN</div>
                        <div class="gr-line"></div>
                        <div>LiteSpeed Web Server</div>
                        <div class="gr-line"></div>
                        <div>cPanel Control Panel</div>
                        <div class="gr-line"></div>
                        <div>FREE SSL Life Time </div>
                        <div class="gr-line"></div>
                        <div>FREE Weekly Backup </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Sub Domains </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Email Accounts </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Databases</div>
                        <div class="gr-line"></div>

                        <br>
                        <button class="btn btn-banner">GET STARTED</button>
                    </div>
                </div>
                <div class="col-sm-4 animate-box" data-animate-effect="fadeInLeft">
                    <div class="price-box">
                        <h3><b>PLAN 4</b></h3>
                        <h3><b>4500TK</b><sub>/Year</sub></h3>
                        <div class="gr-line"></div>
                        <div>10 GB SSD Storage</div>
                        <div class="gr-line"></div>
                        <div>500 GB Data Transfer Monthly</div>
                        <div class="gr-line"></div>
                        <div>10 Addon DOMAIN</div>
                        <div class="gr-line"></div>
                        <div>LiteSpeed Web Server</div>
                        <div class="gr-line"></div>
                        <div>cPanel Control Panel</div>
                        <div class="gr-line"></div>
                        <div>FREE SSL Life Time </div>
                        <div class="gr-line"></div>
                        <div>FREE Weekly Backup </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Sub Domains </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Email Accounts </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Databases</div>
                        <div class="gr-line"></div>

                        <br>
                        <button class="btn btn-banner">GET STARTED</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="price-box animate-box">
                        <h3><b>PLAN 5</b></h3>
                        <h3><b>6000TK</b><sub>/Year</sub></h3>
                        <div class="gr-line"></div>
                        <div>15 GB SSD Storage</div>
                        <div class="gr-line"></div>
                        <div>650 GB Data Transfer Monthly</div>
                        <div class="gr-line"></div>
                        <div>15 Addon DOMAIN</div>
                        <div class="gr-line"></div>
                        <div>LiteSpeed Web Server</div>
                        <div class="gr-line"></div>
                        <div>cPanel Control Panel</div>
                        <div class="gr-line"></div>
                        <div>FREE SSL Life Time </div>
                        <div class="gr-line"></div>
                        <div>FREE Weekly Backup </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Sub Domains </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Email Accounts </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Databases</div>
                        <div class="gr-line"></div>

                        <br>
                        <button class="btn btn-banner">GET STARTED</button>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="price-box animate-box" data-animate-effect="fadeInRight">
                        <h3><b>PLAN 6</b></h3>
                        <h3><b>7000TK</b><sub>/Year</sub></h3>
                        <div class="gr-line"></div>
                        <div>20 GB SSD Storage</div>
                        <div class="gr-line"></div>
                        <div>800 GB Data Transfer Monthly</div>
                        <div class="gr-line"></div>
                        <div>20 Addon DOMAIN</div>
                        <div class="gr-line"></div>
                        <div>LiteSpeed Web Server</div>
                        <div class="gr-line"></div>
                        <div>cPanel Control Panel</div>
                        <div class="gr-line"></div>
                        <div>FREE SSL Life Time </div>
                        <div class="gr-line"></div>
                        <div>FREE Weekly Backup </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Sub Domains </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Email Accounts </div>
                        <div class="gr-line"></div>
                        <div>Unlimited Databases</div>
                        <div class="gr-line"></div>

                        <br>
                        <button class="btn btn-banner">GET STARTED</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    session_start();
    include_once 'footer.php';
    ?>


    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>-->
    <script src="./js/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
    <script src="./js/bootstrap.min.js"></script>
    <!--<script src="https://use.fontawesome.com/8e45396e2e.js"></script>-->
    <script src="./js/fontawesome.js"></script>
    <script src="./js/jquery.waypoints.min.js"></script>
    <script src="./js/animate.js"></script>

</body>

</html>