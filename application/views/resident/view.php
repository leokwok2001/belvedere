<?php $mode_create = array('resident', 'create'); ?>
<?php $mode_edit = array('resident', 'edit'); ?> 
<?php $mode_view = array('resident', 'view'); ?> 
<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu03'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu031'); ?></li>
    </ol>
</div>


<div class="col-sm-12">
    <div id="search" class="collapse">
        <h3>  <?php echo $this->lang->line('resident_search'); ?>  </h3>            

        <form id="searchForm" class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_view); ?>">

            <div class="form-group">
                <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('resident_code'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <input type="text" name="code" class="form-control" id="code"/>    
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="block"><?php echo $this->lang->line('resident_block'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">

                    <select class="form-control" name ="block" d="block">
                        <option value = "" ></option>;
                        <?php
                        for ($i = 1; $i <= 7; $i++) {
                            //echo "The number is: $x <br>";
                            echo '<option value = "' . $i . '" >' . $i . '</option>';
                        }
                        ?>


                    </select>

                </div>

            </div>

            <div class = "form-group">
                <label class = "control-label col-sm-2" for = "floor"><?php echo $this->lang->line('resident_floor');
                        ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
       



                    <select class="form-control" name ="floor" d="floor">
                                   <option value = "" ></option>;
                        <?php
                        for ($x = 1; $x <= 41; $x++) {
                            echo '<option value = "' . $x . '" >' . $x . '</option>';
                        }
                        ?>

                   </select>


                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="unit"><?php echo $this->lang->line('resident_unit'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">


                    <select class="form-control" name ="unit" d="unit">
                        <option value = "" ></option>;
                        <?php
                        for ($u = 65; $u <= 72; $u++) {
                            echo '<option value = "' .chr($u) . '" >' . chr($u) . '</option>';
                        }
                        ?>
                   </select>
                </div>
            </div>



            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search">
                        </span> <?php echo $this->lang->line('button_search'); ?></button>
                </div>
            </div>
            <input type="hidden" name="function" value="search"/>
            <input type="hidden" name="item" value="resident"/>

        </form>            
    </div>
    <div align="right">
        <br/>
        <a href="#search" data-toggle="collapse" data-target="#search"><u> <?php echo $this->lang->line('button_search'); ?></u></a>
    </div>			
</div>	



<div class="container-fluid">

    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
        <thead>
            <tr>
                <td><?php echo $this->lang->line('resident_code'); ?></td>
                <td><?php echo $this->lang->line('resident_block'); ?></td>
                <td><?php echo $this->lang->line('resident_floor'); ?></td>
                <td><?php echo $this->lang->line('resident_unit'); ?></td>

                <td><?php echo $this->lang->line('resident_name1'); ?></td>
                <td><?php echo $this->lang->line('resident_name2'); ?></td>
                <td><?php echo $this->lang->line('resident_tel'); ?></td>
                <td><?php echo $this->lang->line('resident_email'); ?></td>
                <td><?php echo $this->lang->line('resident_paytype'); ?></td>

                <td><?php echo $this->lang->line('owner_code'); ?></td>
                <td><?php echo $this->lang->line('owner_name1'); ?></td>
                <td><?php echo $this->lang->line('owner_name2'); ?></td>
<!--                <td><?php echo $this->lang->line('owner_name3'); ?></td>
                <td><?php echo $this->lang->line('owner_cname1'); ?></td>
                <td><?php echo $this->lang->line('owner_cname2'); ?></td>
                <td><?php echo $this->lang->line('owner_cname3'); ?></td>-->
                <td><?php echo $this->lang->line('owner_tel'); ?></td>
                <td><?php echo $this->lang->line('owner_tel1'); ?></td>
                <td><?php echo $this->lang->line('owner_tel2'); ?></td>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($resident as $reisdent_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $reisdent_item['CODE'] . "'>" . $reisdent_item['CODE'] . " </a>"; ?>     

                    </td>
                    <td><?php echo $reisdent_item['BLOCK']; ?></td>
                    <td><?php echo $reisdent_item['FLOOR']; ?></td>
                    <td><?php echo $reisdent_item['UNIT']; ?></td>

                    <td><?php echo $reisdent_item['NAME1']; ?></td>
                    <td><?php echo $reisdent_item['NAME2']; ?></td>
                    <td><?php echo $reisdent_item['TEL']; ?></td>
                    <td><?php echo $reisdent_item['EMAIL']; ?></td>
                    <td><?php echo ($reisdent_item['PAYTYPE'] === '0') ? 'Cheque' : 'Autopay'; ?></td>

                    <td><?php echo $reisdent_item['CODE11']; ?></td>
                    <td><?php echo $reisdent_item['NAME11']; ?></td>
                    <td><?php echo $reisdent_item['NAME22']; ?></td>
    <!--                    <td><?php echo $reisdent_item['NAME33']; ?></td>
                    <td><?php echo $reisdent_item['CNAME11']; ?></td>
                    <td><?php echo $reisdent_item['CNAME22']; ?></td>
                    <td><?php echo $reisdent_item['CNAME33']; ?></td>-->
                    <td><?php echo $reisdent_item['TEL11']; ?></td>
                    <td><?php echo $reisdent_item['TEL22']; ?></td>
                    <td><?php echo $reisdent_item['TEL33']; ?></td>


                </tr>
            <?php endforeach ?>
        <tbody>
    </table>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create); ?>">                
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('resident_create'); ?></button>
            </div>
        </div>
        <input type="hidden" name="item" value="Resident"/>
    </form>        


</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "scrollY": 350,
            "scrollCollapse": true,
            "scrollX": true
        });
        $('#datePicker1').datetimepicker({
            format: 'YYYY',
            viewMode: "years"
        })

    });
</script>