<?php $mode_edit4 = array('resident', 'unlink'); ?> 
<?php $mode_edit = array('resident', 'edit'); ?> 
<?php $mode_create = array('owner', 'edit'); ?>
<?php $mode_create4 = array('owner_resident', 'create/' . $owner['CODE']); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <h3><?php echo $this->lang->line('owner_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_code"><?php echo $this->lang->line('owner_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code" value ="<?php echo $owner['CODE']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name1"><?php echo $this->lang->line('owner_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1" value ="<?php echo $owner['NAME1']; ?>">
                        <input type="text" name="cname1" class="form-control" id="cname1" value ="<?php echo $owner['CNAME1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name2"><?php echo $this->lang->line('owner_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2" value ="<?php echo $owner['NAME2']; ?>">
                        <input type="text" name="cname2" class="form-control" id="cname2" value ="<?php echo $owner['CNAME2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name3"><?php echo $this->lang->line('owner_name3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name3" class="form-control" id="name3" value ="<?php echo $owner['NAME3']; ?>">
                        <input type="text" name="cname3" class="form-control" id="cname3" value ="<?php echo $owner['CNAME3']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address1"><?php echo $this->lang->line('owner_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address1" class="form-control" id="address1" value ="<?php echo $owner['ADDRESS1']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address2"><?php echo $this->lang->line('owner_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address2" class="form-control" id="address2" value ="<?php echo $owner['ADDRESS2']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address3"><?php echo $this->lang->line('owner_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address3" class="form-control" id="address3" value ="<?php echo $owner['ADDRESS3']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address4"><?php echo $this->lang->line('owner_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address4" class="form-control" id="address4" value ="<?php echo $owner['ADDRESS4']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel"><?php echo $this->lang->line('owner_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel" value ="<?php echo $owner['TEL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel1"><?php echo $this->lang->line('owner_tel1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel1" class="form-control" id="tel1" value ="<?php echo $owner['TEL1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel2"><?php echo $this->lang->line('owner_tel2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel2" class="form-control" id="tel2" value ="<?php echo $owner['TEL2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel3"><?php echo $this->lang->line('owner_tel3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel3" class="form-control" id="tel3" value ="<?php echo $owner['TEL3']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_email"><?php echo $this->lang->line('owner_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="email" class="form-control" id="email" value ="<?php echo $owner['EMAIL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_remarks"><?php echo $this->lang->line('owner_remarks'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <textarea rows="4" cols="50" id="remarks" name="remarks"><?php echo $owner['REMARKS']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_post"><?php echo $this->lang->line('owner_post'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <select class="form-control" name ="post">
                            <option value="P" <?php if ($owner['POST'] === 'P') echo 'selected'; ?> >P</option>
                            <option value="R" <?php if ($owner['POST'] === 'R') echo 'selected'; ?> >R</option>
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
                <input type="hidden" name="item" value="owner"/>
            </form>	
        </div> 
        <div class="col-sm-5">
            <div class="form-group">        
                <div class=" col-sm-12"  >
                    <img src=" <?php echo $owner['PHOTO1']; ?>" alt="face" width="186" height= "267" class="img-rounded" alt="Cinque Terre" width="186" height="267">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"></a>
            </a>
            <h2><?php echo $this->lang->line('resident_tab_otherinfo'); ?></h2>



            <ul class="nav nav-pills">
                <li  class="active">
                    <a data-toggle="tab" href="#home"><?php echo $this->lang->line('owner_tab_resident'); ?></a>
                </li>

            </ul>

            <div class="tab-content">
                <div id="home"  class="tab-pane fade in active">
                    <h2><?php echo $this->lang->line('owner_tab_resident'); ?></h2>

                    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create4); ?>">                
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('property_create'); ?></button>
                            </div>
                        </div>
                        <input type="hidden" name="item" value="carowns"/>
                    </form>  


                    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
                        <thead>
                            <tr>
                                <td><?php echo $this->lang->line('owner_code'); ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resident as $resident_item): ?>
                                <tr>
                                    <td>
                                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $resident_item['CODE'] . "'>" . $resident_item['CODE'] . " </a>"; ?>    | 
                                        <?php echo "<a href='" . site_url($mode_edit4) . "/" . $resident_item['CODE'] . "/" . $owner['CODE'] . "'>" . "unlink" . " </a>"; ?>  
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        // $('table.display').DataTable();
        $('#dataTable').DataTable({
            "scrollY": 350,
            "scrollCollapse": true,
            "scrollX": true
        });

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
                firstname: {
                    validators: {
                        notEmpty: {
                            message: 'The firstname is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The firstname must be less than 255 characters long'
                        }
                    }
                },
                lastname: {
                    validators: {
                        notEmpty: {
                            message: 'The lastname is required and cannot be empty'
                        },
                        stringLength: {
                            max: 255,
                            message: 'The lastname must be less than 255 characters long'
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