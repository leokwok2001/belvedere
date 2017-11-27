<!--
EMAIL
ADDRESS1
ADDRESS2
ADDRESS3
ADDRESS4
REMARKS-->
<?php $owner_mode_eddit = array('ownercarpark', 'edit'); ?> 
<?php $mode_edit = array('genmfree', 'edit'); ?> 
<?php $mode_edit2 = array('payment', 'edit'); ?> 
<?php $mode_edit3 = array('carowns', 'edit'); ?> 
<?php $mode_create = array('driver', 'edit'); ?>
<?php $mode_create3 = array('carowns', 'create/' . $driver['CARPARK']); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <h3><?php echo $this->lang->line('driver_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_code"><?php echo $this->lang->line('driver_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code" value ="<?php echo $driver['CARPARK']; ?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_name1"><?php echo $this->lang->line('driver_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1" value ="<?php echo $driver['NAME1']; ?>">
                        <input type="text" name="cname1" class="form-control" id="cname1" value ="<?php echo $driver['CNAME1']; ?>">

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_name2"><?php echo $this->lang->line('driver_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2" value ="<?php echo $driver['NAME2']; ?>">
                        <input type="text" name="cname2" class="form-control" id="cname2" value ="<?php echo $driver['CNAME2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_tel"><?php echo $this->lang->line('driver_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel" value ="<?php echo $driver['TEL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_email"><?php echo $this->lang->line('driver_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="email" class="form-control" id="email" value ="<?php echo $driver['EMAIL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address1"><?php echo $this->lang->line('driver_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address1" class="form-control" id="address1" value ="<?php echo $driver['ADDRESS1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address2"><?php echo $this->lang->line('driver_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address2" class="form-control" id="address2" value ="<?php echo $driver['ADDRESS2']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address3"><?php echo $this->lang->line('driver_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address3" class="form-control" id="address3" value ="<?php echo $driver['ADDRESS3']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_address4"><?php echo $this->lang->line('driver_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address4" class="form-control" id="address4" value ="<?php echo $driver['ADDRESS4']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_remarks"><?php echo $this->lang->line('driver_remarks'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <textarea rows="4" cols="50" id="remarks" name="remarks"><?php echo $driver['REMARKS']; ?></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="paytype"><?php echo $this->lang->line('driver_paytype'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="paytype">
                        <select class="form-control" name ="paytype">
                            <option value="" <?php if ($driver['PAYTYPE'] == '') echo 'selected'; ?> >  </option>
                            <option value="0" <?php if ($driver['PAYTYPE'] === '0') echo 'selected'; ?> >Cheque</option>
                            <option value="1" <?php if ($driver['PAYTYPE'] === '1') echo 'selected'; ?> >Autopay</option>
                        </select>                  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="payref"><?php echo $this->lang->line('driver_payref'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="payref" class="form-control" id="payref" value ="<?php echo $driver['PAYREF']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="driver_isprint"><?php echo $this->lang->line('driver_isprint'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="isprint">
                        <select class="form-control" name ="isprint">
  
                            <option value="0" <?php if ($driver['ISPRINT'] === '0') echo 'selected'; ?> >YES</option>
                            <option value="1" <?php if ($driver['ISPRINT'] === '1') echo 'selected'; ?> >NO</option>
                       
                        </select>                  
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
                <input type="hidden" name="item" value="driver"/>
            </form>	


        </div>
        <div class="col-sm-5">
            <div class="col-sm-7" style="background-color:lavenderblush;">
                <p> </p>
                <p> </p>
                <p id="photo1">  <?php echo $this->lang->line('owner_detail') . ': '; ?></p> 
                <?php echo "<a href='" . site_url($owner_mode_eddit) . "/" . $driver['CODE11'] . "'>" . $driver['CODE11'] . " </a>"; ?>     
                <input type="text" name="owner_name1" class="form-control" id="owner_name1" readonly="true" value ="<?php echo $driver['NAME11']; ?>">                
                <input type="text" name="owner_name2" class="form-control" id="owner_name2" readonly="true" value ="<?php echo $driver['NAME22']; ?>">
                <input type="text" name="owner_tel1" class="form-control" id="owner_tel1" readonly="true" value ="<?php echo $driver['TEL11']; ?>">
                <input type="text" name="owner_tel2" class="form-control" id="owner_tel2" readonly="true" value ="<?php echo $driver['TEL22']; ?>">
                <input type="text" name="owner_tel3" class="form-control" id="owner_tel3" readonly="true" value ="<?php echo $driver['TEL33']; ?>">
                <input type="text" name="owner_tel4" class="form-control" id="owner_tel4" readonly="true" value ="<?php echo $driver['TEL44']; ?>">
            </div>
        </div> 
    </div>
</div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('table.display').DataTable();
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