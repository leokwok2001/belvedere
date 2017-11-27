<!--

$lang['payment_seq']='Seq';
$lang['payment_code']='Code';
$lang['payment_indate']='In Date';
$lang['payment_amt']='Amount';
$lang['payment_ptype']='Pay Method';
$lang['payment_remarks']='Remarks';

-->

<?php $mode_create = array('payment', 'edit'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('payment_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="seq"><?php echo $this->lang->line('payment_seq'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="seq" class="form-control" id="seq" value="<?php echo $payment['PAYMENTNO']; ?>" readonly="true" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('payment_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code" value="<?php echo $payment['CODE']; ?>" readonly="true" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="indate"><?php echo $this->lang->line('payment_indate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="indate" class="form-control" id="indate" value="<?php echo $payment['INDATE']; ?>">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="payment_amt"><?php echo $this->lang->line('payment_amt'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="amt" class="form-control" id="amt" value="<?php echo $payment['AMT']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="ptype"><?php echo $this->lang->line('payment_ptype'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="ptype">
                        <select class="form-control" name ="ptype">

                            <option value="0" <?php if ($payment['PAYTYPE'] === '0') echo 'selected'; ?> >Cheque</option>
                            <option value="1" <?php if ($payment['PAYTYPE'] === '1') echo 'selected'; ?> >Autopay</option>


                        </select>                  
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2" for="cheqno"><?php echo $this->lang->line('payment_cheqno'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="cheqno">
                        <input type="text" name="cheqno" class="form-control" id="cheqno" value="<?php echo $payment['CHEQNO']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="bankno"><?php echo $this->lang->line('payment_bankno'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="bankno">
                        <input type="text" name="bankno" class="form-control" id="bankno" value="<?php echo $payment['BANKNO']; ?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="bankacno"><?php echo $this->lang->line('payment_bankacno'); ?></label>
                  <div class="col-sm-4 col-sm-offset-right-6" id="bankacno">
                        <input type="text" name="bankacno" class="form-control" id="bankacno"  value="<?php echo $payment['BANKACNO']; ?>" >
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="payment_remarks"><?php echo $this->lang->line('payment_remarks'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <textarea  rows="4" cols="50" name="remarks" class="form-control" id="remarks"><?php echo $payment['REMARKS']; ?> </textarea>
                    </div>
                </div>


                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'back';this.form.submit()"><span class="glyphicon glyphicon-step-backward"></span> <?php echo $this->lang->line('button_black'); ?></button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('button_save'); ?></button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'delete';this.form.submit()"><span class="glyphicon glyphicon-remove"></span> <?php echo $this->lang->line('button_delete'); ?></button>
                        <button type="button" class="btn btn-default" onCLick="this.form.function.value = 'print';this.form.submit()">
                            <span class="glyphicon glyphicon-print"></span><?php echo $this->lang->line('payment_receipts'); ?> </button>&nbsp;&nbsp;
                    </div>
                </div>

                <input type="hidden" name="function" value="update"/>
                <input type="hidden" name="item" value="payment"/>
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
                code: {
                    validators: {
                        notEmpty: {
                            message: 'The code is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The code must be less than 255 characters long'
                        }
                    }
                },
                cheqno: {
                    validators: {
                        notEmpty: {
                            message: 'The cheque no. is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The cheque no. must be less than 255 characters long'
                        }
                    }
                },
                indate: {
                    validators: {
                        notEmpty: {
                            message: 'The indate is required and cannot be empty'
                        }
                    }
                },
                amt: {
                    validators: {
                        notEmpty: {
                            message: 'The amount is required and cannot be empty'
                        },
                        numeric: {
                            message: 'The amount must be numeric'
                        }
                    }
                },
                ptype: {
                    validators: {
                        notEmpty: {
                            message: 'The payment type is required and cannot be empty'
                        }
                    }
                }


            }
        })
    });
</script>