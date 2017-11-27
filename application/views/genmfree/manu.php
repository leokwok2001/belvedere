

<?php $mode_create = array('genmfree', 'manu'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo $this->lang->line('genmfree_manu'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">


                <!--                <div class="form-group">
                                    <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('mfreestatment_code'); ?></label>
                                    <div class="col-sm-4 col-sm-offset-right-6">
                                        <input type="text" name="code" class="form-control" id="code"   >
                                    </div>
                                </div>-->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_code"><?php echo $this->lang->line('mfreestatment_res_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_code" class="form-control" id="res_code"  onkeyup="loadDoc(this.value)" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="mdate"><?php echo $this->lang->line('mfreestatment_mdate'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="mdate" class="form-control" id="mdate" >
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="amt"><?php echo $this->lang->line('mfreestatment_amt'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="amt" class="form-control" id="amt" >
                    </div>
                </div>



                <div  id ="residentdiv" style="display: none;">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="res_block"><?php echo $this->lang->line('mfreestatment_res_block'); ?></label>
                        <div class="col-sm-4 col-sm-offset-right-6">
                            <input type="text" name="res_block" class="form-control" id="res_block" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="res_floor"><?php echo $this->lang->line('mfreestatment_res_floor'); ?></label>
                        <div class="col-sm-4 col-sm-offset-right-6">
                            <input type="text" name="res_floor" class="form-control" id="res_floor"  >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="res_unit"><?php echo $this->lang->line('mfreestatment_res_unit'); ?></label>
                        <div class="col-sm-4 col-sm-offset-right-6">
                            <input type="text" name="res_unit" class="form-control" id="res_unit"  >
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_firstname"><?php echo $this->lang->line('mfreestatment_res_firstname'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_firstname" class="form-control" id="res_firstname"  readonly="true">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="res_lastname"><?php echo $this->lang->line('mfreestatment_res_lastname'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="res_lastname" class="form-control" id="res_lastname" readonly="true">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="address1"><?php echo $this->lang->line('owner_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address1" class="form-control" id="address1" readonly="true">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address2"><?php echo $this->lang->line('owner_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address2" class="form-control" id="address2" readonly="true">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address3"><?php echo $this->lang->line('owner_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address3" class="form-control" id="address3" readonly="true">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address4"><?php echo $this->lang->line('owner_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="address4" class="form-control" id="address4"  readonly="true">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="tel"><?php echo $this->lang->line('owner_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="tel" class="form-control" id="tel"  readonly="true">
                    </div>
                </div>



                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span> 
                            <?php echo $this->lang->line('button_black'); ?>
                        </button>&nbsp;&nbsp;

                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_add'); ?></button>

                    </div>
                </div>

                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="genmfree_manu"/>

            </form>	
        </div> 
    </div>
</div>



<script type="text/javascript">



    function loadDoc(code1) {


        if (code1.length === 4 || code1.length === 6) {
            var xhttp;
            if (window.XMLHttpRequest) {
                // code for modern browsers
                xhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var jsontext = xhttp.responseText;
                    if (jsontext !== "empty!") {
                        var getContact = JSON.parse(jsontext);
                        var getContact_first = getContact[0];

                        if (code1.substring(0, 1) === 'B') {
                            document.getElementById("res_firstname").value = getContact_first.NAME1;
                            document.getElementById("res_lastname").value = getContact_first.NAME2;
                            document.getElementById("address1").value = getContact_first.ADDRESS1;
                            document.getElementById("address2").value = getContact_first.ADDRESS2;
                            document.getElementById("address3").value = getContact_first.ADDRESS3;
                            document.getElementById("address4").value = getContact_first.ADDRESS4;
                            document.getElementById("tel").value = getContact_first.TEL;
                            document.getElementById('res_block').value = '';
                            document.getElementById("res_unit").value = '';
                            document.getElementById("res_floor").value = '';
                            document.getElementById('residentdiv').style.display = "none";
                        } else {
                            document.getElementById("res_firstname").value = getContact_first.NAME1;
                            document.getElementById("res_lastname").value = getContact_first.NAME2;
                            document.getElementById("address1").value = getContact_first.ADDRESS1;
                            document.getElementById("address2").value = getContact_first.ADDRESS2;
                            document.getElementById("address3").value = getContact_first.ADDRESS3;
                            document.getElementById("address4").value = getContact_first.ADDRESS4;
                            document.getElementById("res_block").value = getContact_first.BLOCK1;
                            document.getElementById("res_unit").value = getContact_first.UNIT1;
                            document.getElementById("res_floor").value = getContact_first.FLOOR1;
                            document.getElementById("tel").value = getContact_first.TEL;

                            document.getElementById('residentdiv').style.display = "block";
                        }
                    }
                } else {

                    document.getElementById("res_firstname").value = '';
                    document.getElementById("res_lastname").value = '';
                    document.getElementById("address1").value = '';
                    document.getElementById("address2").value = '';
                    document.getElementById("address3").value = '';
                    document.getElementById("address4").value = '';
                    document.getElementById("res_block").value = '';
                    document.getElementById("res_unit").value = '';
                    document.getElementById("res_floor").value = '';
    document.getElementById("tel").value = '';
                }
            };
            xhttp.open("POST", "/index.php/genmfree/locadownerinfo", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("code1=" + code1);
        } else {
            document.getElementById("res_firstname").value = '';
            document.getElementById("res_lastname").value = '';
            document.getElementById("address1").value = '';
            document.getElementById("address2").value = '';
            document.getElementById("address3").value = '';
            document.getElementById("address4").value = '';
            document.getElementById("res_block").value = '';
            document.getElementById("res_unit").value = '';
            document.getElementById("res_floor").value = '';
                document.getElementById("tel").value = '';
        }
    }
</script>


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