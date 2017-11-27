<?php $mode_edit3 = array('driver', 'edit'); ?> 
<?php $mode_edit5 = array('driver', 'unlink'); ?> 
<?php $mode_create = array('ownercarpark', 'edit'); ?>
<?php $mode_create3 = array('ownercarpark_driver', 'create/' . $ownercarpark['CODE']); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <h3><?php echo $this->lang->line('ownercarpark_edit'); ?></h3>	 
            <form id="addForm" class="form-horizontal"  role="form" method="post" action="<?php echo site_url($mode_create) ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_code"><?php echo $this->lang->line('owner_code'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="code" class="form-control" id="code" value ="<?php echo $ownercarpark['CODE']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name1"><?php echo $this->lang->line('owner_name1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name1" class="form-control" id="name1" value ="<?php echo $ownercarpark['NAME1']; ?>">
                        <input type="text" name="cname1" class="form-control" id="cname1" value ="<?php echo $ownercarpark['CNAME1']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name2"><?php echo $this->lang->line('owner_name2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name2" class="form-control" id="name2" value ="<?php echo $ownercarpark['NAME2']; ?>">
                        <input type="text" name="cname2" class="form-control" id="cname2" value ="<?php echo $ownercarpark['CNAME2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_name3"><?php echo $this->lang->line('owner_name3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="name3" class="form-control" id="name3" value ="<?php echo $ownercarpark['NAME3']; ?>">
                        <input type="text" name="cname3" class="form-control" id="cname3" value ="<?php echo $ownercarpark['CNAME3']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address1"><?php echo $this->lang->line('owner_address1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address1" class="form-control" id="address1" value ="<?php echo $ownercarpark['ADDRESS1']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address2"><?php echo $this->lang->line('owner_address2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address2" class="form-control" id="address2" value ="<?php echo $ownercarpark['ADDRESS2']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address3"><?php echo $this->lang->line('owner_address3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address3" class="form-control" id="address3" value ="<?php echo $ownercarpark['ADDRESS3']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_address4"><?php echo $this->lang->line('owner_address4'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="address4" class="form-control" id="address4" value ="<?php echo $ownercarpark['ADDRESS4']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel"><?php echo $this->lang->line('owner_tel'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel" class="form-control" id="tel" value ="<?php echo $ownercarpark['TEL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel1"><?php echo $this->lang->line('owner_tel1'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel1" class="form-control" id="tel1" value ="<?php echo $ownercarpark['TEL1']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel2"><?php echo $this->lang->line('owner_tel2'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel2" class="form-control" id="tel2" value ="<?php echo $ownercarpark['TEL2']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_tel3"><?php echo $this->lang->line('owner_tel3'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text"  name="tel3" class="form-control" id="tel3" value ="<?php echo $ownercarpark['TEL3']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_email"><?php echo $this->lang->line('owner_email'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <input type="text" name="email" class="form-control" id="email" value ="<?php echo $ownercarpark['EMAIL']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_remarks"><?php echo $this->lang->line('owner_remarks'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <textarea rows="4" cols="50" id="remarks" name="remarks"><?php echo $ownercarpark['REMARKS']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner_post"><?php echo $this->lang->line('owner_post'); ?></label>
                    <div class="col-sm-4 col-sm-offset-right-6">
                        <select class="form-control" name ="post">
                            <option value="P" <?php if ($ownercarpark['POST'] === 'P') echo 'selected'; ?> >P</option>
                            <option value="R" <?php if ($ownercarpark['POST'] === 'R') echo 'selected'; ?> >R</option>
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
                    <img src=" <?php echo $ownercarpark['PHOTO1']; ?>" alt="face" width="186" height= "267" class="img-rounded" alt="Cinque Terre" width="186" height="267">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"></a>
            </a>
            <h2><?php echo $this->lang->line('resident_tab_otherinfo'); ?></h2>


            <!--$lang['owner_tab_resident']='Property';
            $lang['owner_tab_carpark'] = 'Car Park Locations';
            -->
            <ul class="nav nav-pills">

                <li  class="active">
                    <a data-toggle="tab" href="#home"><?php echo $this->lang->line('owner_tab_carpark'); ?></a>
                </li>
            </ul>

            <div class="tab-content">

                <div id="home"  class="tab-pane fade in active">

                    <h2><?php echo $this->lang->line('owner_tab_carpark'); ?></h2>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create3); ?>">                
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('carpark_create'); ?></button>
                            </div>
                        </div>
                        <input type="hidden" name="item" value="carparkowner"/>
                    </form>        

                    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
                        <thead>
                            <tr>
                                <td><?php echo $this->lang->line('driver_code'); ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carpark as $carpark_item): ?>
                                <tr>
                                    <td>
                                        <?php echo "<a href='" . site_url($mode_edit3) . "/" . $carpark_item['CARPARK'] . "'>" . $carpark_item['CARPARK'] . " </a>"; ?>  
                                        | 
                                        <?php echo "<a href='" . site_url($mode_edit5) . "/" . $carpark_item['CARPARK'] . "/" . $ownercarpark['CODE'] . "'>" . "unlink" . " </a>"; ?>
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