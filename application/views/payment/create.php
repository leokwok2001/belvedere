
<?php $mode_create = array('payment', 'create'); ?>
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-7" style="background-color:lavender;">
            <p id="demo"></p>
            <h3><?php echo $this->lang->line('payment_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="code"><?php echo $this->lang->line('payment_code'); ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" name="code" class="form-control" id="code"  onkeyup="loadDoc(this.value)" autofocus="true" >
                        <input type="hidden" name="code2" class="form-control" id="code2"   >
                         
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="indate"><?php echo $this->lang->line('payment_indate'); ?></label>
                    <div class="col-sm-9 ">          
                        <div class="input-group input-append date" id="datePicker1">
                            <input type="text" name="indate" class="form-control" id="indate" value="<?php echo date("Y-m-d"); ?>"> 
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3" for="uptodate_amt"><?php echo $this->lang->line('resident_outstand'); ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" name="uptodate_amt"  style="background:khaki" class="form-control" id="uptodate_amt" readonly="true"  > 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="payment_amt"><?php echo $this->lang->line('payment_amt'); ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" name="amt" class="form-control" id="amt"> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="ptype"><?php echo $this->lang->line('payment_ptype'); ?></label>
                    <div class="col-sm-9 " id="ptype">
                        <select class="form-control" name ="ptype"  id="myselect" onchange="loadPayType()">
                            <option value="0" selected="true">Cheque</option>
                            <option value="1"  >Cash</option>
                        </select>                  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="cheqno"><?php echo $this->lang->line('payment_cheqno'); ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" name="cheqno" class="form-control" id="cheqno">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="bankno"><?php echo $this->lang->line('payment_bankno'); ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" name="bankno" class="form-control" id="bankno" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="bankacno"><?php echo $this->lang->line('payment_bankacno'); ?></label>
                    <!--                    <div class="col-sm-9 ">
                                            <input type="text" name="bankacno" class="form-control" id="bankacno"    >
                                        </div>
                    -->
                    <div class="col-sm-9 ">
                        <select class="form-control" name ="bankacno"  id="bankacno">
                            <option value="" selected="true"></option>
                            <option value="039-747-0-002011-1"  >039-747-0-002011-1(大樓)</option>
                            <option value="039-747-0-003999-9"  >039-747-0-003999-9(車位+部份車位autopay)</option>
                            <option value="039-747-0-002022-1"  >039-747-0-002022-1(部份大樓autopay+部份車位autopay)</option>
                            <option value="012-666-0-009587-2"  >012-666-0-009587-2(部份大樓autopay)</option>
                           
                        </select>       
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="payment_remarks"><?php echo $this->lang->line('payment_remarks'); ?></label>
                    <div class="col-sm-9 ">
                        <textarea  rows="4" cols="50" name="remarks" class="form-control" id="remarks"></textarea>
                    </div>
                </div>

                <input type="hidden" name="tmpjason" class="form-control" id="tmpjason" value ="">

                <div class="form-group"> 
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="button"  class="btn btn-default"
                                onCLick="this.form.function.value = 'back';this.form.submit()">
                            <span class="glyphicon glyphicon-step-backward"></span><?php echo $this->lang->line('button_black'); ?> </button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('button_add'); ?></button>
                    </div>
                </div> 

                <input type="hidden" name="function" value="create"/>
                <input type="hidden" name="item" value="payment"/>
            </form>
        </div> 
        <div class="col-sm-5" style="background-color:lavenderblush;">
            <p id="photo1"></p> 
            <p id="debitnote"></p>
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
                            document.getElementById("photo1").innerHTML = " " +
                                    "<P>" + "NAME1 姓名1:" + getContact_first.FIRSTNAME + "</P>" +
                                    "<P>" + "NAME1 姓名2:" + getContact_first.LASTNAME + "</P>" +
                                    "<P>" + "ADDRESS1 地址1:" + getContact_first.ADDRESS1 + "</P>" +
                                    "<P>" + "ADDRESS2 地址2:" + getContact_first.ADDRESS2 + "</P>" +
                                    "<P>" + "ADDRESS3 地址3:" + getContact_first.ADDRESS3 + "</P>" +
                                    "<P>" + "TEL 電話:" + getContact_first.TEL + "</P>";

                            //document.getElementById("bankacno").value = '03974700039999';


                        } else {

                            document.getElementById("photo1").innerHTML = " " +
                                    "<P>" + "NAME1   姓名1:" + getContact_first.FIRSTNAME + "</P>" +
                                    "<P>" + "NAME1   姓名2:" + getContact_first.LASTNAME + "</P>" +
                                    "<P>" + "UNIT   單位:" + getContact_first.RES_UNIT + "</P>" +
                                    "<P>" + "FLOOR        樓層:" + getContact_first.RES_FLOOR + "</P>" +
                                    "<P>" + "BLOCK        座數:" + getContact_first.RES_BLOCK + "</P>";
                          //  document.getElementById("bankacno").value = '03974700020111';
                        }


                        var t1 = "<form>  <table style='width:100%'><tr> <th><input type='checkbox' name='checkall'  id='checkall' onclick='check_test(2);' > </th>  <th>Debit Note#</th>   <th>Amount</th>  <th>Paid Amount</th> <th>Balance </th>  <th>Period</th> <th> </th>  </tr>  ";
                        var ss = "";
                        var tmpamt1 = 0.00;
                        for (var key in getContact) {
                            if (getContact.hasOwnProperty(key)) {
                                if (getContact[key].IS_PAID === "0") {

                                    ss = ss + " <tr><td> <input type='checkbox' name='check1[]'  onclick='check_test(1);' > </td>" +
                                            "<td> <input type='text' name='code1[]'  value='" + getContact[key].CODE + "' size='8'  readonly ></td>" +
                                            "<td> <input type='text' name='amt1[]'  value='" + getContact[key].AMT + "'  size='8' readonly> </td> " +
                                            "<td> <input type='text' name='paid_amt[]' onchange='calc_ttl();'  value='0'  size='8' style='background:khaki'> " +
                                            " <input type='hidden' name='paid_amt2[]' value='" + getContact[key].AMT + "' > " +
                                            " <input type='hidden' name='paid_amt3[]' value='" + getContact[key].PAID_AMT + "' ></td> " +
                                            "<td> <input type='text' name='different1[]'  value='" + (getContact[key].PAID_AMT - getContact[key].AMT) + "'  size='8' readonly> </td> " +
                                            "<td> <input type='text' name='mdate1[]'  value='" + getContact[key].MDATE + "'  size='5' readonly></td></tr> ";
                                    tmpamt1 += parseFloat(getContact[key].AMT);

                                }

                            }
                        }


                        document.getElementById("debitnote").innerHTML = t1 + ss + "</table> " + "</form>";
                        document.getElementById("uptodate_amt").value = (tmpamt1.toLocaleString('en-US', {minimumFractionDigits: 2}));

                    }
                    document.getElementById("demo").innerHTML = " <div class='alert alert-success'><strong>Success! </strong>Done</div>";
                    document.getElementById("code2").value = "OK";
                    
                } else {
                    document.getElementById("demo").innerHTML = " <div class='alert alert-danger'><strong>Error! </strong>Record not found</div> ";
                    document.getElementById("photo1").innerHTML = "";
                    document.getElementById("debitnote").innerHTML = "";
                    document.getElementById("code2").value = "";
                }
            };
            xhttp.open("POST", "/index.php/payment_barcode/create", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("code1=" + code1);
        } else {
            document.getElementById("demo").innerHTML = "<div class='alert alert-danger'><strong>Error! </strong>invalid format</div>";
            document.getElementById("code2").value = "";
        }
    }
</script>


<script>

    function loadPayType() {

        var x = document.getElementById("myselect").value;
        if (x === '1') {
            document.getElementById("cheqno").value = "CASH";

        } else {

            document.getElementById("cheqno").value = "";

        }

    }


    function calc_ttl() {
        var chk_arr = document.getElementsByName("check1[]");
        var txtcode1 = document.getElementsByName("code1[]");
        var txtamt1 = document.getElementsByName("amt1[]");
        var txtmdate1 = document.getElementsByName("mdate1[]");
        var txtpaid_amt = document.getElementsByName("paid_amt[]");
        var txtpaid_amt3 = document.getElementsByName("paid_amt3[]");
        var different1 = document.getElementsByName("different1[]");

        var chklength = txtpaid_amt.length;
        var tmpamt = 0.00;
        for (k = 0; k < chklength; k++)
        {
            tmpamt += parseFloat(txtpaid_amt[k].value);

            different1[k].value = parseFloat(txtpaid_amt[k].value) - (parseFloat(txtamt1[k].value) - parseFloat(txtpaid_amt3[k].value));

        }
        document.getElementById("amt").value = Math.round((tmpamt * 100) / 100);
        dojason();
    }

    function check_test(type1) {
        var chk_arr = document.getElementsByName("check1[]");
        var checkall = document.getElementById("checkall");
        var txt_paid_amt2 = document.getElementsByName("paid_amt2[]");
        var txt_paid_amt = document.getElementsByName("paid_amt[]");
        var amt1 = document.getElementsByName("amt1[]");
        if (type1 === 1) {
            var chklength = chk_arr.length;
            for (k = 0; k < chklength; k++)
            {
                if (chk_arr[k].checked === true) {
                    txt_paid_amt[k].value = txt_paid_amt2[k].value;
                } else {
                    txt_paid_amt[k].value = 0.00;
                }
            }
        } else {
            var chklength = chk_arr.length;
            if (checkall.checked === true) {
                for (k = 0; k < chklength; k++)
                {
                    txt_paid_amt[k].value = txt_paid_amt2[k].value;
                    chk_arr[k].checked = true;
                }
            } else {
                for (k = 0; k < chklength; k++)
                {
                    txt_paid_amt[k].value = 0;
                    chk_arr[k].checked = false;
                }
            }
        }
        calc_ttl();
    }

    function dojason() {
        var chk_arr = document.getElementsByName("check1[]");
        var txtcode1 = document.getElementsByName("code1[]");
        var txtamt1 = document.getElementsByName("amt1[]");
        var txtmdate1 = document.getElementsByName("mdate1[]");
        var txtpaid_amt = document.getElementsByName("paid_amt[]");
        var different1 = document.getElementsByName("different1[]");
        var tmpelement = "";
        var chklength1 = chk_arr.length;
        for (key = 0; key < chklength1; key++)
        {
            tmpelement = tmpelement + '{ "CODE":"' + txtcode1[key].value + '","MDATE":"' + txtmdate1[key].value + '","DIFFERENT":"' + different1[key].value + '","PAID_AMT":"' + txtpaid_amt[key].value + '","AMT":"' + txtamt1[key].value + '"},';
        }
        var jasondnote = "[" + tmpelement.substr(0, tmpelement.length - 1) + "]";
        document.getElementById("tmpjason").value = jasondnote;
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
                code: {
                    validators: {
                        notEmpty: {
                            message: 'The code is required and cannot be empty'
                        }
                    }
                },
                cheqno: {
                    validators: {
                        notEmpty: {
                            message: 'The code is required and cannot be empty'
                        }
                    }
                },
                
                bankacno: {
                    validators: {
                        notEmpty: {
                            message: 'The bankacno is required and cannot be empty'
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

