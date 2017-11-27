
<?php $mode_create = array('comm_man_payment', 'create'); ?>
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
                    <div class="col-sm-9 ">
<!--                        <input type="text" name="bankacno" class="form-control" id="bankacno" value ="012-666-1-034561-9"  readonly="true">-->

                        <select class="form-control" name ="bankacno"  id="bankacno">
                            <option value="" selected="true"></option>
                            <option value="012-666-1-034561-9"  >012-666-1-034561-9</option>
                            <option value="012-666-1-034704-2"  >012-666-1-034704-2</option>
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
                <input type="hidden" name="item" value="comm_man_payment"/>
            </form>
        </div> 
        <div class="col-sm-5" style="background-color:lavenderblush;">
            <p id="photo1"></p> 
            <p id="debitnote"></p>
        </div>

    </div>
</div>
<!--<button type="button" onclick="loadDoc('1234')"> Change Content</button>-->
<!--<input type="text"  onkeyup="loadDoc(this.value)" /> -->
<!--<p id="demo"></p> -->

<script type="text/javascript">
    function loadDoc(code1) {

        //  the code liength should be 4 to 6 character
        if (code1.length == 4 || code1.length == 6) {
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
                        //document.getElementById("code").value = getContact_first.RES_CODE;
                        //document.getElementById("amt").value = getContact_first.AMT1;

                        if (code1.substring(0, 1) === 'B') {
                            document.getElementById("photo1").innerHTML = " " +
                                    "<P>" + "NAME1 姓名1:" + getContact_first.OWNER_NAME1 + "</P>" +
                                    "<P>" + "NAME1 姓名2:" + getContact_first.OWNER_NAME2 + "</P>" +
                                    "<P>" + "ADDRESS1 地址1:" + getContact_first.OWNER_ADDRESS1 + "</P>" +
                                    "<P>" + "ADDRESS2 地址2:" + getContact_first.OWNER_ADDRESS2 + "</P>" +
                                    "<P>" + "ADDRESS3 地址3:" + getContact_first.OWNER_ADDRESS3 + "</P>" +
                                    "<P>" + "ADDRESS4 地址4:" + getContact_first.OWNER_ADDRESS4 + "</P>" +
                                    "<P>" + "TEL 電話:" + getContact_first.OWNER_TEL + "</P>";

                        } else {

                            document.getElementById("photo1").innerHTML = " " +
                                    "<P>" + "NAME1   姓名1:" + getContact_first.OWNER_NAME1 + "</P>" +
                                    "<P>" + "NAME1   姓名2:" + getContact_first.OWNER_NAME2 + "</P>" +
                                    "<P>" + "UNIT   單位:" + getContact_first.UNIT + "</P>" +
                                    "<P>" + "FLOOR        樓層:" + getContact_first.FLOOR + "</P>" +
                                    "<P>" + "BLOCK        座數:" + getContact_first.BLOCK + "</P>";

                        }
                        var t1 = "<form>  <table style='width:100%'><tr> <th> </th>  <th>Debit Note#</th>   <th>Amount</th>    <th>Period</th> <th> </th>  </tr>  ";
                        var ss = "";
                        for (var key in getContact) {
                            if (getContact.hasOwnProperty(key)) {
                                if (getContact[key].IS_PAID === "0") {
                                    var tmpelement = '{ "CODE":"' + getContact[key].CODE + '","MDATE":"' + getContact[key].MDATE + '","AMT":"' + getContact[key].AMT + '"}';
                                    ss = ss +
                                            " <tr><td> <input type='checkbox' name='check1[]' value='" + tmpelement + "' onclick='check_test();'> </td>" +
                                            "<td>" + getContact[key].CODE + "</td>" +
                                            "<td>" + getContact[key].AMT + " </td> " +
                                            "<td>" + getContact[key].MDATE + "</td></tr> ";
                                }
                            }
                        }

                        //   document.getElementById("debitnote").innerHTML = t1 + ss + "</table> " +
                        //         "<input type='button' value='submit'   onclick='check_test()' /></form>";
                        // document.getElementById("remarks").value = jsontext;
                        document.getElementById("debitnote").innerHTML = t1 + ss + "</table> " + "</form>";
                    }
                    document.getElementById("demo").innerHTML = " <div class='alert alert-success'><strong>Success! </strong>Done</div>";
                    // document.getElementById("remarks").value = "";

                } else {
                    document.getElementById("demo").innerHTML = " <div class='alert alert-danger'><strong>Error! </strong>Record not found</div> ";
                    document.getElementById("photo1").innerHTML = "";
                    document.getElementById("debitnote").innerHTML = "";

                }
                //     document.getElementById("remarks").value = jsontext;

            };


            xhttp.open("POST", "/index.php/payment_barcode/manfee_create", true);

            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("code1=" + code1);
        } else {
            document.getElementById("demo").innerHTML = "<div class='alert alert-danger'><strong>Error! </strong>invalid format</div>";
        }
    }
</script>


<script>

    function loadPayType() {
        //alert("Clicked, new value = " + paytype.value);

        var x = document.getElementById("myselect").value;
        if (x === '1') {
            document.getElementById("cheqno").value = "CASH";
            // document.getElementById("cheqnodiv").innerHTML = "<input type='text' name='cheqno1' class='form-control' id='cheqno1'>";
        } else {
            //    document.getElementById("cheqnodiv").innerHTML = "<input type='text' name='cheqno' class='form-control' id='cheqno'>";
            document.getElementById("cheqno").value = "";

        }
        // alert("You selected: " + x);
    }


    /*  function handleClick(cb) {
     display("Clicked, new value = " + cb.value);
     }
     function rani() {
     $("#btn_").on('click', function () {
     var checkbox_value = "";
     $(":checkbox").each(function () {
     var ischecked = $(this).is(":checked");
     if (ischecked) {
     checkbox_value += $(this).val() + "|";
     }
     });
     alert(checkbox_value);
     });
     }
     */
    function check_test() {

        var chk_arr = document.getElementsByName("check1[]");
        var chklength = chk_arr.length;
        var checkbox_value = "";

        //chk_arr[0].checked = true;
        for (k = 0; k < chklength; k++)
        {
            if (chk_arr[k].checked === true) {
                // alert(chk_arr[k].value);
                checkbox_value += chk_arr[k].value + ",";

            }
        }

        var jasondnote = "[" + checkbox_value.substr(0, checkbox_value.length - 1) + "]";
        document.getElementById("tmpjason").value = jasondnote;
        var getCont1 = JSON.parse(jasondnote);
        var tmpamt = 0.00;
        for (var key in getCont1) {
            if (getCont1.hasOwnProperty(key)) {
                tmpamt += parseFloat(getCont1[key].AMT);
                //      document.getElementById("remarks").value = getCont1[key].CODE;
            }
        }
        // alert(tmpamt);
        document.getElementById("amt").value = Math.round((tmpamt * 100) / 100);


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

