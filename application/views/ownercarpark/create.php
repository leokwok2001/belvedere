<!--
$lang['owner_code'] = '編號';
$lang['owner_firstname'] = '名稱';
$lang['owner_lastname']='姓氏';
$lang['owner_tel'] = '電話';
$lang['owner_email'] ='電郵';
$lang['owner_paytype'] = '付款方式';-->


<?php $mode_create = array('ownercarpark', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3> <?php echo $this->lang->line('owner_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_code"><?php echo $this->lang->line('owner_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name1"><?php echo $this->lang->line('owner_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1">
                        <input type="text" name="cname1" class="form-control" id="cname1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name2"><?php echo $this->lang->line('owner_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2">
                        <input type="text" name="cname2" class="form-control" id="cname2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name3"><?php echo $this->lang->line('owner_name3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name3" class="form-control" id="name3">
                        <input type="text" name="cname3" class="form-control" id="cname3">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel"><?php echo $this->lang->line('owner_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel1"><?php echo $this->lang->line('owner_tel1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel1" class="form-control" id="tel1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel2"><?php echo $this->lang->line('owner_tel2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel2" class="form-control" id="tel2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel3"><?php echo $this->lang->line('owner_tel3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel3" class="form-control" id="tel3">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address1"><?php echo $this->lang->line('owner_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address1" class="form-control" id="owner_address1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address2"><?php echo $this->lang->line('owner_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address2" class="form-control" id="owner_address2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address3"><?php echo $this->lang->line('owner_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address3" class="form-control" id="owner_address3">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address4"><?php echo $this->lang->line('owner_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address4" class="form-control" id="owner_address4">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_email"><?php echo $this->lang->line('owner_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_remarks"><?php echo $this->lang->line('owner_remarks'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <textarea rows="4" cols="50" id="remarks" name="remarks"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_post"><?php echo $this->lang->line('owner_post'); ?></label>

                    <div class="col-sm-4 col-sm-offset-right-6" id="owner_post">
                        <select class="form-control" name ="post">

                            <option value="R">R</option>
                            <option value="P">P</option>
                        </select>                  
                    </div>

                </div>

                <!--                <div class="form-group">
                                    <label class="control-label col-sm-2" for="paytype"><?php echo $this->lang->line('owner_paytype'); ?></label>
                                    <div class="col-sm-4 col-sm-offset-right-6" id="paytype">
                                        <select class="form-control" name ="paytype">
                                            <option value="">  </option>
                                            <option value="0">Cheque</option>
                                            <option value="1">Autopay</option>
                                        </select>                  
                                    </div>
                                </div>-->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="photo"><?php echo $this->lang->line('owner_photo'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">           
                        <input type="file" name="userfile"  size="20"  class="form-control" />
                    </div>
                </div>


                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" 
                                onCLick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?></button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span><?php echo $this->lang->line('button_add'); ?></button>
                    </div>
                </div> 
                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="owner"/>

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
                code: {
                    validators: {
                        notEmpty: {
                            message: 'The code  is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The code must be less than 255 characters long'
                        }
                    }
                },
                name1: {
                    validators: {
                        notEmpty: {
                            message: 'The name1 is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The name1 must be less than 255 characters long'
                        }
                    }
                }
            
                
            }
        })
    });
</script>