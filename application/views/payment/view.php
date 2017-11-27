<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu01'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu012'); ?></li>
    </ol>
</div>
<?php $mode_create = array('payment', 'create'); ?>
<?php $mode_edit = array('payment', 'edit'); ?> 
<?php $mode_update_status = array('payment', 'update_status2'); ?> 
<?php $mode_view = array('payment', 'view'); ?> 
<?php $mode_unpresentcheque = array('payment', 'unpresent_cheque'); ?> 
<div class="col-sm-12">
    <div id="search" class="collapse">
        <h3>  <?php echo $this->lang->line('payment_search'); ?>  </h3>            
        <form id="searchForm" class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_view); ?>">
            <div class="form-group">
                <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('payment_status'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <select class="form-control" name ="is_paid_status">
                        <option value=""></option>
                        <option value="ALL">All</option>
                        <option value="0">Wait for Confirm</option>
                        <option value="1">Confirmed</option>
                        <option value="2">Return Cheque</option>
                    </select>       
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="cat1"><?php echo $this->lang->line('payment_cat'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <select class="form-control" name ="cat1" >
                        <option value=""> </option>
                        <option value="R">RESIDENT</option>
                        <option value="C">CARPARK</option>
                    </select>       
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="fromdate"><?php echo 'From ' . $this->lang->line('payment_indate'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">          
                    <div class="input-group input-append date" id="datePicker1">
                        <input type="text" name="fromdate" class="form-control" id="fromdate" >
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="todate"><?php echo 'To ' . $this->lang->line('payment_indate'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">          
                    <div class="input-group input-append date" id="datePicker2">
                        <input type="text" name="todate" class="form-control" id="todate" >
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> <?php echo $this->lang->line('button_search'); ?></button>
                </div>
            </div>
            <input type="hidden" name="function" value="search"/>
            <input type="hidden" name="item" value="payment"/>
        </form>            
    </div>
    <div align="right">
        <br/>
        <a href="#search" data-toggle="collapse" data-target="#search"><u> <?php echo $this->lang->line('button_search'); ?></u></a>
    </div>			
</div>	


        <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_view); ?>">               

<div class="container-fluid">
    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
        <thead>
            <tr>
                <td><?php echo $this->lang->line('payment_seq'); ?></td>
                <td><?php echo $this->lang->line('payment_code'); ?></td>
                <td><?php echo $this->lang->line('payment_indate'); ?></td>
                <td><?php echo $this->lang->line('payment_amt'); ?></td>
                <td><?php echo $this->lang->line('payment_cheqno'); ?></td>
                <td><?php echo $this->lang->line('payment_is_paid_status'); ?></td>
                <td><input type="checkbox" name="chkall1"  id="chkall1"    />Select</td>
            </tr>
        </thead>
        <tbody>

            <?php
            $amttotal = 0.00;
            $amttotal2 = 0.00;
            ?>
            <?php foreach ($payment as $payment_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $payment_item['PAYMENTNO'] . "'>" . $payment_item['PAYMENTNO'] . " </a>"; ?>     
                    </td>
                 <!--   <td><?php echo $payment_item['PAYMENT_REF']; ?></td> -->
                    <td><?php echo $payment_item['CODE']; ?></td>
                    <td><?php echo $payment_item['INDATE']; ?></td>
                    <td><?php echo number_format($payment_item['AMT'], 2); ?></td>
                <!--    <td><?php echo $payment_item['PAYTYPE'] === '0' ? 'Cheque' : 'Autopay'; ?></td> -->
                    <td><?php echo $payment_item['CHEQNO']; ?></td>
                    <td><?php echo ($payment_item['IS_PAID'] == TRUE ? '<span class="glyphicon glyphicon-ok"></span> ' : '<span class="glyphicon glyphicon-remove"></span> ' ); ?>  | 
                        <?php
                        echo "<a href='" . site_url($mode_update_status) . "/" . $payment_item['PAYMENTNO'] . "/" . 'TRUE' . "'>" . $this->lang->line('payment_confirm') . " </a>";
                        echo "|";
                        echo "<a href='" . site_url($mode_unpresentcheque) . "/" . $payment_item['PAYMENTNO'] . "'>" . 'RETURN CHQ.' . " </a>";
                        ?>     
                    </td>                   

                    <td><input type="checkbox" name="chk1[]"  value="<?php echo $payment_item['PAYMENTNO']; ?>"/></td>

                </tr>

                <?php
                if ($payment_item['IS_PAID'] != 2) {
                    $amttotal = $amttotal + $payment_item['AMT'];
                }

                if ($payment_item['IS_PAID'] == 2) {
                    $amttotal2 = $amttotal2 + $payment_item['AMT'];
                }
                ?>

            <?php endforeach ?>
        <tbody>
    </table>

    
        
 
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default" onCLick="this.form.submit()">
                                        <span class="glyphicon glyphicon-ok"></span> <?php echo $this->lang->line('button_confirm_all'); ?></button>
            </div>
        </div>
        <input type="hidden" name="function" value="confirmall"/>
    </form>      
    

    <div class="col-sm-offset-8 col-sm-2">

        <h2> <span class="label label-primary"><?php echo 'Total $HKD ' . number_format($amttotal, 2); ?></span></h2>
        <h2> <span class="label label-primary"><?php echo 'Return Cheque Total $HKD ' . number_format($amttotal2, 2); ?></span></h2>
    </div>



    

    
    
</div>


<script type="text/javascript">

       
   $('#chkall1').click(function () {
        var table = $('#dataTable').DataTable();
        $(':checkbox', table.rows().nodes()).prop('checked', this.checked);
    });
       


</script>
<script type="text/javascript">


    $(document).ready(function () {
        $('#dataTable').DataTable({
             "lengthMenu": [[-1,10, 25, 50, -1], ["All",10, 25, 50]],
            "order": [0, "desc"],
            "scrollY": 350,
            "scrollCollapse": true,
            "scrollX": true
        });
        $('#datePicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: "years"
        });
        $('#datePicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: "months"
        })

    });
</script>