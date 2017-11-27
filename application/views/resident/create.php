
<?php $mode_create = array('resident', 'create'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3> <?php echo $this->lang->line('resident_create'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>" accept-charset="utf-8" enctype="multipart/form-data">


                <div class="form-group">
                    <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('resident_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="name1"><?php echo $this->lang->line('resident_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="name2"><?php echo $this->lang->line('resident_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="tel"><?php echo $this->lang->line('resident_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="block"><?php echo $this->lang->line('resident_block'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="block" class="form-control" id="block">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="floor"><?php echo $this->lang->line('resident_floor'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="floor" class="form-control" id="floor">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="unit"><?php echo $this->lang->line('resident_unit'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="unit" class="form-control" id="unit">
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2" for="building"><?php echo $this->lang->line('resident_building'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">

                        <select class="form-control" name ="building">
                            <option value="">  </option>
                            <option value="Belvedere Garden Phase 3">Belvedere Garden Phase 3</option>

                        </select>        



                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email"><?php echo $this->lang->line('resident_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                </div>




 


                <div class="form-group">
                    <label class="control-label col-sm-2" for="paytype"><?php echo $this->lang->line('resident_paytype'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6" id="paytype">
                        <select class="form-control" name ="paytype">
                            <option value="">  </option>
                            <option value="0">Cheque</option>
                            <option value="1">Autopay</option>
                        </select>                  
                    </div>
                </div>




                <div class="form-group">
                    <label class="control-label col-sm-2" for="photo"><?php echo $this->lang->line('resident_photo'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">           
                        <input type="file" name="userfile"  size="20"  class="form-control" />
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
                <input type="hidden" name="item" value="resident"/>

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
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The incorrect email address'
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