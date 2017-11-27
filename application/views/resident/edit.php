
<?php $owner_mode_eddit = array('owner', 'edit'); ?> 
<?php $mode_edit = array('genmfree', 'edit'); ?> 
<?php $mode_edit2 = array('payment', 'edit'); ?> 
<?php $mode_edit3 = array('carowns', 'edit'); ?> 
<?php $mode_create = array('resident', 'edit'); ?>
<?php $mode_create3 = array('carowns', 'create/' . $resident['CODE']); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <h3><?php echo $this->lang->line('resident_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('resident_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code" value ="<?php echo $resident['CODE']; ?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="name1"><?php echo $this->lang->line('resident_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1" value ="<?php echo $resident['NAME1']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name2"><?php echo $this->lang->line('resident_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2" value ="<?php echo $resident['NAME2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="tel"><?php echo $this->lang->line('resident_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel" value ="<?php echo $resident['TEL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="block"><?php echo $this->lang->line('resident_block'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="block" class="form-control" id="block" value ="<?php echo $resident['BLOCK']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="floor"><?php echo $this->lang->line('resident_floor'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="floor" class="form-control" id="floor" value ="<?php echo $resident['FLOOR']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="unit"><?php echo $this->lang->line('resident_unit'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="unit" class="form-control" id="unit" value ="<?php echo $resident['UNIT']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="building"><?php echo $this->lang->line('resident_building'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">


                        <select class="form-control" name ="building">
                            <option value="" <?php if ($resident['BUILDING'] == '') echo 'selected'; ?> >  </option>
                            <option value="Belvedere Garden Phase 3" <?php if ($resident['BUILDING'] == 'Belvedere Garden Phase 3') echo 'selected'; ?> >Belvedere Garden Phase 3</option>


                        </select>      

                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><?php echo $this->lang->line('resident_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="email" class="form-control" id="email" value ="<?php echo $resident['EMAIL']; ?>">
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2" for="paytype"><?php echo $this->lang->line('resident_paytype'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="paytype">
                        <select class="form-control" name ="paytype">

                            <option value="" <?php if ($resident['PAYTYPE'] == '') echo 'selected'; ?> >  </option>
                            <option value="0" <?php if ($resident['PAYTYPE'] === '0') echo 'selected'; ?> >Cheque</option>
                            <option value="1" <?php if ($resident['PAYTYPE'] === '1') echo 'selected'; ?> >Autopay</option>

                        </select>                  
                    </div>
                </div>




                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'back';this.form.submit()"><span class="glyphicon glyphicon-step-backward"></span> <?php echo $this->lang->line('button_black'); ?></button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('button_save'); ?></button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-default" onclick="this.form.function.value = 'delete';this.form.submit()"><span class="glyphicon glyphicon-remove"></span> <?php echo $this->lang->line('button_delete'); ?></button>
                        <!--                        <button type="button" class="btn btn-default" onCLick="this.form.function.value = 'payrecord_create';this.form.submit()">
                                                    <span class="glyphicon glyphicon-plus-sign"></span> 
                        <?php echo $this->lang->line('payment_create'); ?>
                                                </button>    -->

                    </div>
                </div>

                <input type="hidden" name="function" value="update"/>
                <input type="hidden" name="item" value="resident"/>
            </form>	



            <!--            <button type="button" class="btn btn-danger">
            <?php echo $this->lang->line('payment_due_amt'); ?> 
                            <span class="badge"><?php
            echo empty($outstanding) ? 'NIL' : number_format($outstanding['P_OUTSTAND'], 2);
            ?></span></button>  -->



        </div> 
        <div class="col-sm-5">
            <div class="form-group">        
                <div class=" col-sm-12"  >
                    <img src=" <?php echo $resident['PHOTO1']; ?>" alt="face" width="186" height= "267" class="img-rounded" alt="Cinque Terre" width="186" height="267">
                </div>
            </div>
            <div class="col-sm-7" style="background-color:lavenderblush;">
                <p> </p>
                <p> </p>
                <p id="photo1">  <?php echo $this->lang->line('owner_detail') . ': '; ?></p> 
                
                 <?php echo "<a href='" . site_url($owner_mode_eddit) . "/" . $resident['CODE11'] . "'>" . $resident['CODE11'] . " </a>"; ?>     
                <input type="text" name="owner_name1" class="form-control" id="owner_name1" readonly="true" value ="<?php echo $resident['NAME11']; ?>">                
                <input type="text" name="owner_name2" class="form-control" id="owner_name2" readonly="true" value ="<?php echo $resident['NAME22']; ?>">
                
                
                <input type="text" name="owner_tel1" class="form-control" id="owner_tel1" readonly="true" value ="<?php echo $resident['TEL11']; ?>">
                <input type="text" name="owner_tel2" class="form-control" id="owner_tel2" readonly="true" value ="<?php echo $resident['TEL22']; ?>">
                <input type="text" name="owner_tel3" class="form-control" id="owner_tel3" readonly="true" value ="<?php echo $resident['TEL33']; ?>">
                <input type="text" name="owner_tel4" class="form-control" id="owner_tel4" readonly="true" value ="<?php echo $resident['TEL44']; ?>">
                
                
                
            </div>

        </div>




    </div>
</div>





<!--<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12"></a>
            </a>
            <h2><?php echo $this->lang->line('resident_tab_otherinfo'); ?></h2>

            <ul class="nav nav-pills">
                <li>
                    <a data-toggle="tab" href="#home"><?php echo $this->lang->line('resident_tab_debitnote'); ?></a>
                </li>
                <li  class="active">
                    <a data-toggle="tab" href="#menu1"><?php echo $this->lang->line('resident_tab_paymentrecord'); ?></a>
                </li>

                <li>
                    <a data-toggle="tab" href="#menu2"><?php echo $this->lang->line('resident_tab_carpark'); ?></a>
                </li>


            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade ">
                    <h2><?php echo $this->lang->line('resident_tab_debitnote'); ?></h2>
                    <table id="" class="display"  cellspacing="0" width="100%" >
                        <thead>
                            <tr>

                                <td><?php echo $this->lang->line('mfreestatment_code'); ?></td>
                          
                                <td><?php echo $this->lang->line('mfreestatment_res_unit'); ?></td>
                                <td><?php echo $this->lang->line('mfreestatment_res_block'); ?></td>
                                <td><?php echo $this->lang->line('mfreestatment_res_floor'); ?></td>
                                <td><?php echo $this->lang->line('mfreestatment_amt'); ?></td>
                                <td><?php echo $this->lang->line('mfreestatment_mdate'); ?></td>
                                      <td><?php echo $this->lang->line('genmfree_is_paid_status'); ?></td>

                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($genmfree as $mfreestatment_item): ?>
                                                                                <tr>
                                                                                    <td>
    <?php echo "<a href='" . site_url($mode_edit) . "/" . $mfreestatment_item['CODE'] . "'>" . $mfreestatment_item['CODE'] . " </a>"; ?>     

                                                                                    </td>
                                                                              
                                                                                    <td><?php echo $mfreestatment_item['RES_UNIT']; ?></td>
                                                                                    <td><?php echo $mfreestatment_item['RES_BLOCK']; ?></td>
                                                                                    <td><?php echo $mfreestatment_item['RES_FLOOR']; ?></td>
                                                                                    <td><?php echo number_format($mfreestatment_item['AMT'], 2); ?></td>
                                                                                    <td><?php echo $mfreestatment_item['MDATE']; ?></td>
                                                                                          <td><?php echo ($mfreestatment_item['IS_PAID'] == TRUE ? 'PAID' : '--' ); ?></td>

                                                                                </tr>
<?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade in active">
                    <h2><?php echo $this->lang->line('resident_tab_paymentrecord'); ?></h2>

                    <table id="" class="display"  cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <td><?php echo $this->lang->line('payment_seq'); ?></td>
                               
                                <td><?php echo $this->lang->line('payment_code'); ?></td>
                                <td><?php echo $this->lang->line('payment_indate'); ?></td>
                                <td><?php echo $this->lang->line('payment_amt'); ?></td>
                                <td><?php echo $this->lang->line('payment_ptype'); ?></td>
                                <td><?php echo $this->lang->line('payment_status'); ?></td>
                                
                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($payment as $payment_item): ?>
                                                                                <tr>
                                                                                    <td><?php echo "<a href='" . site_url($mode_edit2) . "/" . $payment_item['PAYMENTNO'] . "'>" . $payment_item['PAYMENTNO'] . " </a>"; ?></td>
                                                                               
                                                                                    <td><?php echo $payment_item['CODE']; ?></td>
                                                                                    <td><?php echo $payment_item['INDATE']; ?></td>
                                                                                    <td><?php echo number_format($payment_item['AMT'], 2); ?></td>
                                                                                    <td><?php echo $payment_item['CHEQNO'] ?></td>
                                                                                     <td><?php echo $payment_item['IS_PAID'] === '1' ? 'Confirmed' : 'Wait for Confirm' ?></td>
                                                                                </tr>
<?php endforeach ?>
                        </tbody>
                    </table>

                      
                </div>

                <div id="menu2" class="tab-pane fade">
                    <h2><?php echo $this->lang->line('resident_tab_carpark'); ?></h2>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create3); ?>">                
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('carowns_create'); ?></button>
                            </div>
                        </div>
                        <input type="hidden" name="item" value="carowns"/>

                    </form>        

                    <table id="" class="display"  cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <td><?php echo $this->lang->line('carowns_location'); ?></td>

                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($carowns as $carowns_item): ?>
                                                                                <tr>
                                                                                    <td><?php echo "<a href='" . site_url($mode_edit3) . "/" . $carowns_item['LOCATIONS'] . "'>" . $carowns_item['LOCATIONS'] . " </a>"; ?></td>

                                                                                </tr>
<?php endforeach ?>
                        </tbody>
                    </table>

                      
                </div>




            </div>
        </div>

    </div>
</div>-->
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
                },
                name2: {
                    validators: {
                        notEmpty: {
                            message: 'The name2 is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The name2 must be less than 255 characters long'
                        }
                    }
                },
                tel: {
                    validators: {
                        notEmpty: {
                            message: 'The tel is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The tel must be less than 255 characters long'
                        }
                    }
                },
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
                floor: {
                    validators: {
                        notEmpty: {
                            message: 'The floor is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The floor  must be less than 255 characters long'
                        }
                    }
                },
                building: {
                    validators: {
                        notEmpty: {
                            message: 'The building is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The building  must be less than 255 characters long'
                        }
                    }
                }
            }
        })
    });
</script>