<!--$lang['mfree_edit'] = '修改管理費';
$lang['mfree_create'] = '新增管理費';
$lang['mfree_code'] = '編號';
$lang['mfree_block'] = '座數';
$lang['mfree_unit'] = '單位';
$lang['mfree_size'] = '面積';
$lang['mfree_free'] = '費用';
$lang['mfree_eff_date'] = '生效日期';
-->

<?php $mode_create = array('genmanfee', 'edit'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('genmfree_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">


                <div class="form-group">
                    <label class="control-label col-sm-2" for="manfeestatment_code"><?php echo $this->lang->line('manfeestatment_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code" value ="<?php echo $genmanfee['CODE']; ?>"/>
                    </div>
                </div>

                <div class="form-group" >
                    <label class="control-label col-sm-2" for="manfeestatment_res_code"><?php echo $this->lang->line('manfeestatment_res_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_code" class="form-control" id="res_code" value ="<?php echo $genmanfee['RES_CODE']; ?>">
                    </div>
                </div>

                <div class="form-group"  
                     
                     <?php 
                           echo  substr($genmanfee['RES_CODE'],0,1)=='B' ?  "hidden='true'"  : " ";
                         ?>
                     >
                    <label class="control-label col-sm-2" for="manfeestatment_res_block"><?php echo $this->lang->line('manfeestatment_res_block'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_block" class="form-control" id="res_block" value ="<?php echo $genmanfee['BLOCK']; ?>">
                    </div>
                </div>

                <div class="form-group"
                                       <?php 
                           echo  substr($genmanfee['RES_CODE'],0,1)=='B' ?  "hidden='true'"  : " ";
                         ?>
                     >
                    <label class="control-label col-sm-2" for="manfeestatment_res_floor"><?php echo $this->lang->line('manfeestatment_res_floor'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_floor" class="form-control" id="res_floor" value ="<?php echo $genmanfee['FLOOR']; ?>">
                    </div>
                </div>

                <div class="form-group"
                     
                                       <?php 
                           echo  substr($genmanfee['RES_CODE'],0,1)=='B' ?  "hidden='true'"  : " ";
                         ?>
                     >
                    <label class="control-label col-sm-2" for="manfeestatment_res_unit"><?php echo $this->lang->line('manfeestatment_res_unit'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_unit" class="form-control" id="res_unit" value ="<?php echo $genmanfee['UNIT']; ?>">
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2" for="manfeestatment_res_name1"><?php echo $this->lang->line('manfeestatment_res_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_name1" class="form-control" id="res_firstname" value ="<?php echo $genmanfee['OWNER_NAME1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="manfeestatment_res_name2"><?php echo $this->lang->line('manfeestatment_res_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_name2" class="form-control" id="res_lastname" value ="<?php echo $genmanfee['OWNER_NAME2']; ?>">
                    </div>
                </div>

                
                   <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address1"><?php echo $this->lang->line('owner_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address1" class="form-control" id="address1" value ="<?php echo $genmanfee['OWNER_ADDRESS1']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address2"><?php echo $this->lang->line('owner_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address2" class="form-control" id="address2" value ="<?php echo $genmanfee['OWNER_ADDRESS2']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address3"><?php echo $this->lang->line('owner_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address3" class="form-control" id="address3" value ="<?php echo $genmanfee['OWNER_ADDRESS3']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address4"><?php echo $this->lang->line('owner_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address4" class="form-control" id="address4" value ="<?php echo $genmanfee['OWNER_ADDRESS4']; ?>">
                    </div>
                </div>
                
                
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="manfeestatment_amt"><?php echo $this->lang->line('manfeestatment_amt'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="amt" class="form-control" id="amt" value ="<?php echo $genmanfee['AMT']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="mamfeestatment_mdate"><?php echo $this->lang->line('manfeestatment_mdate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="billdate" class="form-control" id="mdate" value ="<?php echo $genmanfee['BILLDATE']; ?>">
                    </div>
                </div>


                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span> 
                            <?php echo $this->lang->line('button_black'); ?>
                        </button>&nbsp;&nbsp;

                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-pencil"></span> 
                            <?php echo $this->lang->line('button_save'); ?>
                        </button>&nbsp;&nbsp;

                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'delete';this.form.submit()">
                            <span class="glyphicon glyphicon-remove"></span> 
                            <?php echo $this->lang->line('button_delete'); ?>
                        </button>

                        <button type="button" class="btn btn-default" onCLick="this.form.function.value = 'print';this.form.submit()">
                            <span class="glyphicon glyphicon-print"></span><?php echo $this->lang->line('genmfree_rpt'); ?> </button>&nbsp;&nbsp;

                        <!--                        <button type="button" class="btn btn-default" onCLick="this.form.function.value = 'payrecord_create';this.form.submit()">
                                                    <span class="glyphicon glyphicon-plus-sign"></span> 
                        <?php echo $this->lang->line('payment_create'); ?>
                                                </button>-->

                    </div>
                </div>

                <input type="hidden" name="function" value="update"/>
                <input type="hidden" name="item" value="genmanfee"/>

            </form>	
        </div> 
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#datePicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        });
        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                block: {
                    validators: {
                        notEmpty: {
                            message: 'The block is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The block must be less than 255 characters long'
                        }
                    }
                },
                unit: {
                    validators: {
                        notEmpty: {
                            message: 'The unit is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The unit must be less than 255 characters long'
                        }
                    }
                },
                size: {
                    validators: {
                        notEmpty: {
                            message: 'The size is required and cannot be empty'
                        },
                        integer: {
                            message: 'The size must be numeric'
                        }
                    }
                },
                free: {
                    validators: {
                        notEmpty: {
                            message: 'The free is required and cannot be empty'
                        },
                        numeric: {
                            message: 'The free must be numeric'
                        }
                    }
                }
            }
        })
    });
</script>