<!--$lang['mfree_edit'] = '修改管理費';
$lang['mfree_create'] = '新增管理費';
$lang['mfree_code'] = '編號';
$lang['mfree_block'] = '座數';
$lang['mfree_unit'] = '單位';
$lang['mfree_size'] = '面積';
$lang['mfree_free'] = '費用';
$lang['mfree_eff_date'] = '生效日期';
-->

<?php $mode_create = array('carmfee', 'edit'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('carmfee_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('carmfee_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="seq" class="form-control" id="seq" value ="<?php echo $carmfee['SEQ']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="free"><?php echo $this->lang->line('carmfee_fee'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="fee" class="form-control" id="fee" value ="<?php echo $carmfee['FEE']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="eff_date"><?php echo $this->lang->line('carmfee_eff_date'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="eff_date" class="form-control" id="datePicker1" value ="<?php echo $carmfee['EFF_DATE']; ?>">
                    </div>
                </div>
 
               
                <div class="form-group">
                    <label class="control-label col-sm-2" for="carpark"><?php echo $this->lang->line('carmfee_type'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="carpark" class="form-control" id="seq" value ="<?php echo $carmfee['CARPARK']; ?>">
                    </div>
                </div>



                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'back';this.form.submit()"><span class="glyphicon glyphicon-step-backward"></span> <?php echo $this->lang->line('button_black'); ?></button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('button_save'); ?></button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'delete';this.form.submit()"><span class="glyphicon glyphicon-remove"></span> <?php echo $this->lang->line('button_delete'); ?></button>
                    </div>
                </div>

                <input type="hidden" name="function" value="update"/>
                <input type="hidden" name="item" value="carmfee"/>
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
                fee: {
                    validators: {
                        notEmpty: {
                            message: 'The fee is required and cannot be empty'
                        },
                        numeric: {
                            message: 'The fee must be numeric'
                        }
                    }
                }
            }
        })
    });
</script>