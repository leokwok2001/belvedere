<!--$lang['mfree_edit'] = '修改管理費';
$lang['mfree_create'] = '新增管理費';
$lang['mfree_code'] = '編號';
$lang['mfree_block'] = '座數';
$lang['mfree_unit'] = '單位';
$lang['mfree_size'] = '面積';
$lang['mfree_free'] = '費用';
$lang['mfree_eff_date'] = '生效日期';
-->
<?php $mode_create = array('mfree', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('mfree_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="description"><?php echo $this->lang->line('mfree_description'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2" for="unit"><?php echo $this->lang->line('mfree_unit'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="unit" class="form-control" id="unit">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="free"><?php echo $this->lang->line('mfree_free'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="free" class="form-control" id="free">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="eff_date"><?php echo $this->lang->line('mfree_eff_date'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="eff_date" class="form-control" id="eff_date">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" 
                                onCLick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?> </button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_add'); ?></button>
                    </div>
                </div> 
                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="mfree"/>
            </form>
        </div> 
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datePicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'months'
        });
        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                description: {
                    validators: {
                        notEmpty: {
                            message: 'The description is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The description must be less than 255 characters long'
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
                }


            }
        })
    });
</script>