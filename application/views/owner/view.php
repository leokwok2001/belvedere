<?php $mode_create = array('owner', 'create'); ?>
<?php $mode_edit = array('owner', 'edit'); ?> 
<?php $mode_view = array('owner', 'view'); ?> 
<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu03'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu036'); ?></li>
    </ol>
</div>


<div class="col-sm-12">
    <div id="search" class="collapse">
        <h3>  <?php echo $this->lang->line('resident_search'); ?>  </h3>            

        <form id="searchForm" class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_view); ?>">

            <div class="form-group">
                <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('owner_code'); ?></label>
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
                        for ($x = 1; $x <= 7; $x++) {
                            echo '<option value = "' . $x . '" >' . $x . '</option>';
                        }
                        ?>

                    </select>



                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="floor"><?php echo $this->lang->line('resident_floor'); ?></label>
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
                        for ($x = 65; $x <= 72; $x++) {
                            echo '<option value = "' . chr($x) . '" >' . chr($x) . '</option>';
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
            <input type="hidden" name="item" value="owner"/>

        </form>            
    </div>
    <div align="right">
        <br/>
        <a href="#search" data-toggle="collapse" data-target="#search"><u> <?php echo $this->lang->line('button_search'); ?></u></a>
    </div>			
</div>	



<div class="container-fluid">

    <table id="dataTable" class="table table-bordered table-striped nowrap"  width="100%">
        <thead>
            <tr>
                <td><?php echo $this->lang->line('owner_code'); ?></td>
                <td><?php echo $this->lang->line('resident_code'); ?></td>
                <td><?php echo $this->lang->line('resident_block'); ?></td>
                <td><?php echo $this->lang->line('resident_floor'); ?></td>
                <td><?php echo $this->lang->line('resident_unit'); ?></td>
                <td><?php echo $this->lang->line('owner_name1'); ?></td>
                <td><?php echo $this->lang->line('owner_name2'); ?></td>
                <td><?php echo $this->lang->line('owner_tel'); ?></td>
                <td><?php echo $this->lang->line('owner_email'); ?></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($owner as $owner_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $owner_item['CODE'] . "'>" . $owner_item['CODE'] . " </a>"; ?>     
                    </td>
                    <td><?php echo $owner_item['CODE1']; ?></td>
                    <td><?php echo $owner_item['BLOCK1']; ?></td>
                    <td><?php echo $owner_item['FLOOR1']; ?></td>
                    <td><?php echo $owner_item['UNIT1']; ?></td>
                    <td><?php echo $owner_item['NAME1']; ?></td>
                    <td><?php echo $owner_item['NAME2']; ?></td>
                    <td><?php echo $owner_item['TEL']; ?></td>
                    <td><?php echo $owner_item['EMAIL']; ?></td>

                </tr>
            <?php endforeach ?>
        <tbody>
    </table>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create); ?>">                
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('owner_create'); ?></button>
            </div>
        </div>
        <input type="hidden" name="item" value="Owner"/>
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