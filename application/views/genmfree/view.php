<!--

$lang['mfreestatment_code']='管理費單號';
$lang['mfreestatment_res_unit']='單位';
$lang['mfreestatment_res_block']='座數';
$lang['mfreestatment_res_floor']='樓層';
$line('mfreestatment_amt') ='金額' ;
$line('mfreestatment_mdate')='日期'

-->
<?php $mode_create = array('genmfree', 'create'); ?>
<?php $mode_edit = array('genmfree', 'edit'); ?> 
<?php $mode_view = array('genmfree', 'view'); ?> 
<?php $mode_update_status = array('payment', 'update_status'); ?> 


<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu01'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu011'); ?></li>
    </ol>
</div>

<div class="col-sm-12">
    <div id="search" class="collapse">
        <h3>  <?php echo $this->lang->line('genmfree_search'); ?>  </h3>            
        <form id="searchForm" class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_view); ?>">


            <div class="form-group">
                <label class="control-label col-sm-2" for="cat"><?php echo $this->lang->line('genmfree_cat'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <select class="form-control" name ="cat">
                        <option value=""> </option>
                        <option value="R">RESIDENT</option>
                        <option value="C">CARPARK</option>
                    </select>       
                </div>
            </div>



            <div class="form-group">
                <label class="control-label col-sm-2" for="is_paid_status"><?php echo $this->lang->line('genmfree_is_paid_status'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <select class="form-control" name ="is_paid_status">
                        <option value=""> </option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>       
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="block"><?php echo $this->lang->line('mfree_block'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <input type="text" name="block" class="form-control" id="block"/>    
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="floor"><?php echo $this->lang->line('mfree_floor'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <input type="text" name="floor" class="form-control" id="floor"/>    
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="unit"><?php echo $this->lang->line('mfree_unit'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <input type="text" name="unit" class="form-control" id="unit"/>    
                </div>
            </div>







            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search">
                        </span> <?php echo $this->lang->line('button_search'); ?></button>
                </div>
            </div>
            <input type="hidden" name="function" value="search"/>
            <input type="hidden" name="item" value="gnemfree"/>

        </form>            
    </div>
    <div align="right">
        <br/>
        <a href="#search" data-toggle="collapse" data-target="#search"><u> <?php echo $this->lang->line('button_search'); ?></u></a>
    </div>			
</div>	



<div class="container-fluid">
    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
        <thead>
            <tr>

                <td><?php echo $this->lang->line('mfreestatment_code'); ?></td>

                <td><?php echo $this->lang->line('genmfree_is_paid_status'); ?> </td>
                <td><?php echo $this->lang->line('mfreestatment_res_code'); ?></td>
                <td><?php echo $this->lang->line('mfreestatment_res_firstname'); ?> </td>
                <td><?php echo $this->lang->line('mfreestatment_res_lastname'); ?> </td>
                <td><?php echo $this->lang->line('mfreestatment_res_tel'); ?> </td>

                <td><?php echo $this->lang->line('mfreestatment_res_unit'); ?></td>
                <td><?php echo $this->lang->line('mfreestatment_res_block'); ?></td>
                <td><?php echo $this->lang->line('mfreestatment_res_floor'); ?></td>
                <td><?php echo $this->lang->line('mfreestatment_amt'); ?></td>
                <td><?php echo $this->lang->line('mfreestatment_mdate'); ?> </td>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($genmfree as $mfreestatment_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $mfreestatment_item['CODE'] . "'>" . $mfreestatment_item['CODE'] . " </a>"; ?>     

                    </td>



                    <td><?php echo ($mfreestatment_item['IS_PAID'] == TRUE ? '<span class="glyphicon glyphicon-ok"></span> ' : '<span class="glyphicon glyphicon-remove"></span> ' ); ?>   

                        <!--|
                        <?php echo "<a href='" . site_url($mode_update_status) . "/" . $mfreestatment_item['CODE'] . "/" . 'TRUE' . "'>" . $this->lang->line('mfreestatment_res_status_paid') . " </a>"; ?>     
                        
                        
                                                /
                        <?php echo "<a href='" . site_url($mode_update_status) . "/" . $mfreestatment_item['CODE'] . "/" . 'FALSE' . "'>" . $this->lang->line('mfreestatment_res_status_nopaid') . " </a>"; ?>     
                        
                        -->

                    </td>
                    <td><?php echo $mfreestatment_item['RES_CODE']; ?></td>
                    <td><?php echo $mfreestatment_item['RES_FIRSTNAME']; ?></td>
                    <td><?php echo $mfreestatment_item['RES_LASTNAME']; ?></td>
                    <td><?php echo $mfreestatment_item['RES_TEL']; ?></td>

                    <td><?php echo $mfreestatment_item['RES_UNIT']; ?></td>
                    <td><?php echo $mfreestatment_item['RES_BLOCK']; ?></td>
                    <td><?php echo $mfreestatment_item['RES_FLOOR']; ?></td>
                    <td><?php echo number_format($mfreestatment_item['AMT'], 2); ?></td>
                    <td><?php echo $mfreestatment_item['MDATE']; ?></td>

                </tr>
            <?php endforeach ?>
        <tbody>
    </table>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create); ?>">                
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">


                <button type="button" class="btn btn-default" 
                        onCLick="this.form.function.value = 'create';this.form.submit()">
                    <span class="glyphicon glyphicon-transfer"></span><?php echo $this->lang->line('genmfree_create'); ?> </button>&nbsp;&nbsp;



                <button type="button" class="btn btn-default" 
                        onCLick="this.form.function.value = 'print';this.form.submit()">
                    <span class="glyphicon glyphicon-print"></span><?php echo $this->lang->line('genmfree_rpt'); ?> </button>&nbsp;&nbsp;



            </div>
        </div>

        <input type="hidden" name="function" value=""/>
        <input type="hidden" name="item" value="genmfree"/>
    </form>        


</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "order": [10, "desc"],
            "scrollY": 350,
            "scrollCollapse": true,
            "scrollX": true
        });
        $('#datePicker1').datetimepicker({
            format: 'YYYY',
            viewMode: "years"
        })

    });
</script>