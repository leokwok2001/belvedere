
<?php $mode_create = array('genmfree_batch_rpt', 'create_pdf'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('genmfree_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">


                <div class="form-group">
                    <label class="control-label col-sm-2" for="cat"><?php echo $this->lang->line('genmfree_cat'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <select class="form-control" name ="cat"  onchange="getval(this);">
                            <option value=""> </option>
                            <option value="R">RESIDENT</option>
                            <option value="C">CARPARK</option>
                        </select>       
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="mdate"><?php echo $this->lang->line('genmfree_mdate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="mdate" class="form-control" id="mdate">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="porr">P or R</label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <select class="form-control" name ="porr"  >
                            <option value=""> </option>
                            <option value="P">P</option>
                            <option value="R">R</option>
                            <option value="ALL">ALL</option>
                        </select>       
                    </div>
                </div>

                <div class="form-group"  id="blockselect" style="display: none;">
                    <label class="control-label col-sm-2" for="chkblock">Block</label>
                    <div class="col-sm-4 col-sm-offset-right-6">    
                        <label  >
                            <input type="checkbox" class="radio" value="1" name="chkblock[]" />1</label>
                        <label  >
                            <input type="checkbox" class="radio" value="2" name="chkblock[]" />2</label>
                        <label >
                            <input type="checkbox" class="radio" value="3" name="chkblock[]" />3</label>
                        <label >
                            <input type="checkbox" class="radio" value="4" name="chkblock[]" />4</label>
                        <label >
                            <input type="checkbox" class="radio" value="5" name="chkblock[]" />5</label>
                        <label >
                            <input type="checkbox" class="radio" value="6" name="chkblock[]" />6</label>
                        <label >
                            <input type="checkbox" class="radio" value="7" name="chkblock[]" />7</label>
                    </div>
                </div>
                <div class="form-group"  id="basementdiv" style="display: none;">
                    <label class="control-label col-sm-2" for="basementdiv">Basement</label>
                    <div class="col-sm-4 col-sm-offset-right-6">    
                        <label  >
                            <input type="checkbox" class="radio" value="1" name="chkbasement[]" />1</label>
                        <label  >
                            <input type="checkbox" class="radio" value="2" name="chkbasement[]" />2</label>
                        <label >
                            <input type="checkbox" class="radio" value="3" name="chkbasement[]" />3</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="allowautopay"><?php echo $this->lang->line('genmfree_allowautopayprint'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">          
                            <input type="checkbox" name="allowautopay"  value="YES" id="allowautopay">
                    </div>
                </div>
        </div>

        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" 
                        onCLick="this.form.function.value = 'back';this.form.submit()">
                    <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?> </button>&nbsp;&nbsp;

                <button type="submit" class="btn btn-default"
                        onCLick="this.form.function.value = 'print';this.form.submit()">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_process'); ?></button>
            </div>
        </div> 

        <input type="hidden" name="function" value=""/>
        <input type="hidden" name="item" value="genmanfee"/>

        </form>

    </div> 
</div>

<script type="text/javascript">

    function getval(sel) {
        if (sel.value === 'R') {
            document.getElementById('blockselect').style.display = "block";
            document.getElementById('basementdiv').style.display = "none";
        } else {
            document.getElementById('blockselect').style.display = "none";
            document.getElementById('basementdiv').style.display = "block";

        }
    }

    $(document).ready(function () {


        $('#datePicker1').datetimepicker({
            format: 'YYYY-MM',
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
                mdate: {
                    validators: {
                        notEmpty: {
                            message: 'The date is required and cannot be empty'
                        }
                    }
                }
            }
        })

    });
</script>