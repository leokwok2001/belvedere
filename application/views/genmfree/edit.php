<!--$lang['mfree_edit'] = '修改管理費';
$lang['mfree_create'] = '新增管理費';
$lang['mfree_code'] = '編號';
$lang['mfree_block'] = '座數';
$lang['mfree_unit'] = '單位';
$lang['mfree_size'] = '面積';
$lang['mfree_free'] = '費用';
$lang['mfree_eff_date'] = '生效日期';
-->

<?php $mode_create = array('genmfree', 'edit'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('genmfree_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">


                <div class="form-group">
                    <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('mfreestatment_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">

                        <input type="text" name="code" class="form-control" id="code" value ="<?php echo $genmfree['CODE']; ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_code"><?php echo $this->lang->line('mfreestatment_res_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_code" class="form-control" id="res_code" value ="<?php echo $genmfree['RES_CODE']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_block"><?php echo $this->lang->line('mfreestatment_res_block'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_block" class="form-control" id="res_block" value ="<?php echo $genmfree['RES_BLOCK']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_unit"><?php echo $this->lang->line('mfreestatment_res_unit'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_unit" class="form-control" id="res_unit" value ="<?php echo $genmfree['RES_UNIT']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_floor"><?php echo $this->lang->line('mfreestatment_res_floor'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_floor" class="form-control" id="res_floor" value ="<?php echo $genmfree['RES_FLOOR']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_firstname"><?php echo $this->lang->line('mfreestatment_res_firstname'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_firstname" class="form-control" id="res_firstname" value ="<?php echo $genmfree['RES_FIRSTNAME']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_lastname"><?php echo $this->lang->line('mfreestatment_res_lastname'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_lastname" class="form-control" id="res_lastname" value ="<?php echo $genmfree['RES_LASTNAME']; ?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="address1"><?php echo $this->lang->line('owner_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address1" class="form-control" id="res_lastname" value ="<?php echo $genmfree['ADDRESS1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address2"><?php echo $this->lang->line('owner_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address2" class="form-control" id="res_lastname" value ="<?php echo $genmfree['ADDRESS2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address3"><?php echo $this->lang->line('owner_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address3" class="form-control" id="res_lastname" value ="<?php echo $genmfree['ADDRESS3']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address4"><?php echo $this->lang->line('owner_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address4" class="form-control" id="res_lastname" value ="<?php echo $genmfree['ADDRESS4']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_lastname"><?php echo $this->lang->line('mfreestatment_amt'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="amt" class="form-control" id="amt" value ="<?php echo $genmfree['AMT']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="mdate"><?php echo $this->lang->line('mfreestatment_mdate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="mdate" class="form-control" id="mdate" value ="<?php echo $genmfree['INDATE']; ?>">
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
                <input type="hidden" name="item" value="genmfree"/>

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