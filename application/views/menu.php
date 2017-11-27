<?php $resident = array('resident', 'view'); ?>
<?php $mfree = array('mfree', 'view'); ?>
<?php $genmfree_create = array('genmfree', 'create'); ?>
<?php $genmfree = array('genmfree', 'view'); ?>
<?php $genmfree_manu = array('genmfree', 'manu'); ?>
<?php $payment = array('payment', 'view'); ?>
<?php $resident_rpt = array('resident_rpt', 'create_pdf'); ?>
<?php $outstanding_rpt = array('outstanding_rpt', 'create_pdf'); ?>
<?php $outstanding_by_block_rpt = array('outstanding_rpt', 'create_pdf/BLOCK'); ?>
<?php $car_mfee = array('carmfee', 'view'); ?>
<?php $gen_carmfee = array('gencarmfee', 'view'); ?>
<?php $carpayment = array('carpayment', 'view'); ?>
<?php $language_URL = array('LanguageSwitcher', 'switchLang') ?>
<?php $payment_auto = array('readexcel', 'create') ?>
<?php $carpayment_auto = array('carreadexcel', 'create') ?>
<?php $user_logout = array('user', 'logout') ?>
<?php $owner = array('owner', 'view') ?>
<?php $driver = array('driver', 'view') ?>
<?php $owner_carpark = array('ownercarpark', 'view') ?>
<?php $payment_create = array('payment', 'create'); ?>
<?php $genmfree_attachment = array('genmfree', 'attachment'); ?>
<?php $comm_man_payment_create = array('comm_man_payment', 'create'); ?>
<?php $comm_bank_excel = array('comm_bank_excel', 'view'); ?>
<?php $mfee_bank_excel = array('comm_bank_excel', 'mfeeview'); ?>
<?php $comm_man_paymentreceipts = array('comm_man_paymentreceipts', 'view'); ?>
<?php $paymentreceipts = array('paymentreceipts', 'view'); ?>
<?php $genmanfee = array('genmanfee', 'view') ?>
<?php $comm_man_payment = array('comm_man_payment', 'view'); ?>

<div class="container-fluid">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $this->lang->line('menu00'); ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('menu03'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='" . site_url($owner) . "'>" . $this->lang->line('menu036') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($resident) . "'>" . $this->lang->line('menu031') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($mfree) . "'>" . $this->lang->line('menu032') . "</a></li>"; ?>
                            <!--                            <?php echo "<li><a href='" . site_url($payment) . "'>" . $this->lang->line('menu034') . "</a></li>"; ?> -->
                            <!--                                 <?php echo "<li><a href='" . site_url($payment_auto) . "'>" . $this->lang->line('menu035') . "</a></li>"; ?> -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $this->lang->line('menu04'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='" . site_url($owner_carpark) . "'>" . $this->lang->line('menu046') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($driver) . "'>" . $this->lang->line('menu047') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($car_mfee) . "'>" . $this->lang->line('menu041') . "</a></li>"; ?>
                            <!--     <?php echo "<li><a href='" . site_url($carpayment_auto) . "'>" . $this->lang->line('menu044') . "</a></li>"; ?>  -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $this->lang->line('menu01'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='" . site_url($genmfree) . "'>" . $this->lang->line('menu011') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($payment) . "'>" . $this->lang->line('menu012') . "</a></li>"; ?> 
                            <?php echo "<li><a href='" . site_url($genmfree_create) . "'>" . $this->lang->line('menu013') . "</a></li>"; ?> 

                            <!--                                <?php echo "<li><a href='" . site_url($genmfree_manu) . "'>" . $this->lang->line('menu014') . "</a></li>"; ?> -->

                            <?php echo "<li><a href='" . site_url($payment_create) . "'>" . $this->lang->line('menu015') . "</a></li>"; ?> 
                
                                <?php echo "<li><a href='" . site_url($genmfree_attachment) . "'>" . $this->lang->line('menu016') . "</a></li>"; ?>
            <?php echo "<li><a href='" . site_url($paymentreceipts) . "'>" . $this->lang->line('menu074') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($mfee_bank_excel) . "'>" . $this->lang->line('menu017') . "</a></li>"; ?>
                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $this->lang->line('menu07'); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='" . site_url($genmanfee) . "'>" . $this->lang->line('menu037') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($comm_man_payment) . "'>" . $this->lang->line('menu071') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($comm_man_payment_create) . "'>" . $this->lang->line('menu072') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($comm_bank_excel) . "'>" . $this->lang->line('menu073') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($comm_man_paymentreceipts) . "'>" . $this->lang->line('menu074') . "</a></li>"; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $this->lang->line('menu05'); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='" . site_url($resident_rpt) . "'>" . $this->lang->line('menu051') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($outstanding_rpt) . "'>" . $this->lang->line('menu052') . "</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($outstanding_by_block_rpt) . "'>" . $this->lang->line('menu053') . "</a></li>"; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $this->lang->line('language'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='" . site_url($language_URL) . "/english" . "'>English</a></li>"; ?>
                            <?php echo "<li><a href='" . site_url($language_URL) . "/chinese" . "'>Chinese</a></li>"; ?>
                        </ul>
                    </li> 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><?php echo "<li><a href='" . site_url($user_logout) . "'>" . $this->lang->line('menu06') . "</a></li>"; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>	
</div>
<div class="container-fluid">
    <?php echo "Login Name:" ?>
    <?php echo $this->session->userdata("LOGIN_NAME"); ?>
</div>