
<?php $mode_create = array('comm_bank_excel', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('comm_man_payrecord2excel'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">




                <div class="form-group">
                    <label class="control-label col-sm-2" for="bankacno"><?php echo $this->lang->line('payment_bankno'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          


                        <select class="form-control" name ="bankacno"  id="bankacno">
                            <option value="" selected="true"></option>
                            <option value="012-666-1-034561-9"  >012-666-1-034561-9</option>
                            <option value="012-666-1-034704-2"  >012-666-1-034704-2</option>
                        </select>     

                    </div>
                </div>




                <div class="form-group">
                    <label class="control-label col-sm-2" for="date1"><?php echo $this->lang->line('payment_indate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="date1" class="form-control" id="indate">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date2"><?php echo $this->lang->line('payment_indate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                        <div class="input-group input-append date" id="datePicker2">
                            <input type="text" name="date2" class="form-control" id="indate">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>


                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" 
                                onCLick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?> </button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_process'); ?></button>
                    </div>
                </div> 

                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="genmfree"/>

            </form>
        </div> 
    </div>
</div>
<script type="text/javascript">

//     function onchangeshare(sel) {
//        if (sel.value === 'R') {
//           // document.getElementById('blockselect').style.display = "block";
//           document.getElementById("each_share1").value ="950.00";
//        } else {
//           // document.getElementById('blockselect').style.display = "none";
//           document.getElementById("each_share1").value = "1200.00";
//        }
//    }



    $(document).ready(function () {
        $('#datePicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'months'
        });
        $('#datePicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'months'
        });

        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }

        })

    });
</script>