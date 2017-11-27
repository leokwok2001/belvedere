<?php
if ($this->session->userdata('LOGIN_NAME')) {
    
} else { 
    redirect('/user/login/', 'refresh');
    
}
?>


<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>麗城花園管理系統</title>

        <!--bootstrap basic -->


        <link rel="stylesheet" type="text/css" href="<?php echo(CSS . 'bootstrap.min.css'); ?>">
        <script src= "<?php echo(JS . 'jquery.min.1.12.0.js'); ?>"></script>
        <script src= "<?php echo(JS . 'bootstrap.min.js'); ?>"></script>
        
        
        

        <!--bootstrapValidator-->

        <link rel="stylesheet" type="text/css" href="<?php echo(CSS . 'bootstrapValidator.min.0.5.2.css'); ?>">
        <script src= "<?php echo(JS . 'bootstrapValidator.min.0.5.2.js'); ?>"></script>


        <!--datetimepicker -->

        <script src= "<?php echo(JS . 'moment.min.2.8.2.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo(CSS . 'bootstrap-datetimepicker.4.17.37.css'); ?>">
        <script src= "<?php echo(JS . 'bootstrap-datetimepicker.min.4.17.37.js'); ?>"></script>



        <!--datatable -->


        <link rel="stylesheet" type="text/css" href="<?php echo(CSS . 'dataTables.bootstrap.min.1.10.11.css'); ?>">
        
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
      
        
        <script src= "<?php echo(JS . 'jquery.dataTables.min.1.10.11.js'); ?>"></script>
        <script src= "<?php echo(JS . 'dataTables.bootstrap.min.1.10.11.js'); ?>"></script>

        
        

    </head>
    <body>
        <div class="container-fluid">
            <!--     <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
     
                     <ol class="carousel-indicators">
                         <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                         <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                         <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
                     </ol>
                     <div class="carousel-inner" role="listbox">
                         <div class="item active">
                             <img src="<?php echo(IMG . '03.png'); ?>" alt="...">
                             <div class="carousel-caption">
                                 <BR>
                                 <H2>麗城花園</H2>
                                 <h3>業主立案法團</H3>
                             </div>
                         </div>
                         <div class="item">
                          <img src="<?php echo(IMG . '05.jpg'); ?>" alt="...">
                             <div class="carousel-caption">
                                 <H2>麗城花園</H2>
                                 <H3>Belvedere Garden</H2>
                                     <H3>物業管理系統</H3>
                             </div>
                         </div>
                     </div>
                     <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                         <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                         <span class="sr-only">Previous</span>
                     </a>
                     <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                         <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                         <span class="sr-only">Next</span>
                     </a>
                 </div> -->
        </div>




