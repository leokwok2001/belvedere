
<?php $mode_create = array('driver', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3> <?php echo $this->lang->line('driver_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">


                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_code"><?php echo $this->lang->line('driver_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_name1"><?php echo $this->lang->line('driver_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1">
                        <input type="text" name="cname1" class="form-control" id="cname1">

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_name2"><?php echo $this->lang->line('driver_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2">
                        <input type="text" name="cname2" class="form-control" id="cname2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_tel"><?php echo $this->lang->line('driver_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_email"><?php echo $this->lang->line('driver_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="email" class="form-control" id="email" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address1"><?php echo $this->lang->line('driver_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address1" class="form-control" id="address1" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address2"><?php echo $this->lang->line('driver_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address2" class="form-control" id="address2" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address3"><?php echo $this->lang->line('driver_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address3" class="form-control" id="address3" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address4"><?php echo $this->lang->line('driver_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address4" class="form-control" id="address4" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_remarks"><?php echo $this->lang->line('driver_remarks'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <textarea rows="4" cols="50" id="remarks" name="remarks"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_paytype"><?php echo $this->lang->line('driver_paytype'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="paytype">
                        <select class="form-control" name ="paytype">
                            <option value="">  </option>
                            <option value="0">Cheque</option>
                            <option value="1">Autopay</option>
                        </select>                  
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_payref"><?php echo $this->lang->line('driver_payref'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="payref" class="form-control" id="payref" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_photo"><?php echo $this->lang->line('driver_photo'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">           
                        <input type="file" name="userfile"  size="20"  class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_isprint"><?php echo $this->lang->line('driver_isprint'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="isprint">
                        <select class="form-control" name ="isprint">
                            <option value="0">YES</option>
                            <option value="1">NO</option>
                        </select>                  
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
                <input type="hidden" name="item" value="driver"/>

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