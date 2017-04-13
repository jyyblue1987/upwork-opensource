<section class="container-fluid top_header ">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>find-jobs">Winjob</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url() ?>find-jobs"><i class="fa fa-briefcase" aria-hidden="true"></i> Find Job  </a></li>
                    <li><a href="<?php echo site_url('win-jobs') ?>">  <img src="<?php echo base_url() ?>assets/img/version1/cup.png" style="height:20px; width:10px; margin-top:0px;"> Win Jobs  </a></li> 
                    <li><a href="#"><i class="fa fa-cc-discover" aria-hidden="true"></i>  Balance </a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i class="fa fa-envelope-o " aria-hidden="true"></i></a> </li> 
                    <li><a href="#"><i class="fa fa-bell-o " aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0);" style="text-transform:uppercase;color:#FFF;font-size: 22px" data-toggle="dropdown"> HI <?php echo $this->session->userdata("fname"); ?> 
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('profile-settings') ?>">My Profile</a></li>
                            <li><a href="<?php echo site_url('profile-settings') ?>">Settings</a></li>
                            <li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>
<div id="next_header">
    <div class="container">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="menu">
                    <ul>  
                        <li><a href="<?php echo site_url('find-jobs'); ?>" class="current"> Find Jobs  </a></li>      
                        <li><a href="<?php echo base_url() ?>profile/my-freelancer-profile"> My Profile </a></li>			
                        <li><a href="<?php echo site_url('jobs/my-bids'); ?>"> My Bids</a></li>
                        <li><a href="#"> Withdraw</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="line"> </div>
