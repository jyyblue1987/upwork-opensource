<style>
    .notification {
        background: #35adda none repeat scroll 0 0;
        color: #fff;
        height: auto;
        left: -6px;
        min-width: 250px;
        padding: 10px;
        position: absolute;
        top: 110px;
        width: 100%;
        z-index: 99999;
    }

    .notification p.noti-block {
        background-color: rgba(0, 0, 0, 0.18);
        padding: 6px;
    }

    .notification p span.details {
        display: block;
        color: #fff;
        font-size: 12px;
    }

    .notification p span.name {
        display: block;
        text-transform: capitalize;
        color: #fff;
    }

    .notification p span.name img {
        width: 28px;
        margin-bottom: 3px;
        border-radius: 50%;
    }

    .notification p.noti-block a {
        text-decoration: none;
    }

    .inside ul li{
    list-style-type: none;
    }

    .dropdown-menu{
        font-size: 12px;
        font-family: arial;
        width: 320px; 
        padding: 10px 10px 10px 10px;
    }

    .dropdown-menu ul li{
        border-bottom: 1px solid #dddfe2;
    }

    .dropdown-menu ul li a{
        font-size: 12px;
    }

    .dropdown-menu ul li:last-child{
        border: none;
        font-size: 12px;
    }

    .date-li{
        margin-top: 2px;
        color: #90949c;
        font-size: 11px;
        margin-bottom: 5px;
        float: right;
    }

    .triangle-with-shadow {
        width: 75px;
        height: 75px;
        position: absolute;
        top: -75px;
        right: 0px;
        overflow: hidden;
    }

    .triangle-with-shadow:after {
        content: "";
        position: absolute;
        width: 50px;
        height: 50px;
        background: #fff;
        transform: rotate(45deg);
        top: 75px;
        left: 25px;
        box-shadow: -1px -1px 10px -2px rgba(0,0,0,0.5);
    }
</style>
</head>
<body ng-app="app" ng-controller="Ctrl">
    <section class="container-fluid top_header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(); ?>">WINJOB</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Hire Freelancers </a></li>
                        <li><a href="#"> How it Works</a></li>
                        <li><a href="<?= site_url().'freelance-jobs' ?>">  Find Jobs</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo site_url("signin/") ?>">Log In</a></li>
                        <li><a href="<?php echo site_url("signup/") ?>">Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <section class="main_area" id="mid_contant">
    <div class="container">



