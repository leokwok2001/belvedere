<?php $mode_create = array('driver', 'create'); ?>
<?php $mode_edit = array('driver', 'edit'); ?> 
<?php $mode_view = array('driver', 'view'); ?> 
<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu04'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu047'); ?></li>
    </ol>
</div>


<div class="col-sm-12">
    <div id="search" class="collapse">
        <h3>  <?php echo $this->lang->line('driver_search'); ?>  </h3>            

        <form id="searchForm" class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_view); ?>">

            <div class="form-group">
                <label class="control-label col-sm-2" for="code"><?php echo $this->lang->line('driver_code'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <input type="text" name="code" class="form-control" id="code"/>    
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ownercarpark_basement1"><?php echo $this->lang->line('ownercarpark_basement1'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <select class="form-control" name ="basement_1" d="basement_1">
                        <option value = "" ></option>;
                        <?php
                        for ($x = 1; $x <= 3; $x++) {
                            echo '<option value = "B' . $x . '" >B' . $x . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ownercarpark_basement2"><?php echo $this->lang->line('ownercarpark_basement2'); ?></label>
                <div class="col-sm-4 col-sm-offset-right-6">
                    <input type="text" name="basement_2" class="form-control" id="basement_2"/>    
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
            <input type="hidden" name="item" value="driver"/>

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
                <td><?php echo $this->lang->line('driver_code'); ?></td>
                <td><?php echo $this->lang->line('owner_code'); ?></td>

                <td><?php echo $this->lang->line('driver_name1'); ?></td>
                <td><?php echo $this->lang->line('driver_name2'); ?></td>
                <td><?php echo $this->lang->line('driver_tel'); ?></td>

                <td><?php echo $this->lang->line('owner_name1'); ?></td>
                <td><?php echo $this->lang->line('owner_name2'); ?></td>

                <td><?php echo $this->lang->line('driver_paytype'); ?></td>
                <td><?php echo $this->lang->line('driver_isprint'); ?></td>
                

            </tr>
        </thead>
        <tbody>
            <?php foreach ($driver as $reisdent_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $reisdent_item['CARPARK'] . "'>" . $reisdent_item['CARPARK'] . " </a>"; ?>
                    </td>
                    <td><?php echo $reisdent_item['OWNERCODE']; ?></td>
                    <td><?php echo $reisdent_item['NAME1']; ?></td>
                    <td><?php echo $reisdent_item['NAME2']; ?></td>
                    <td><?php echo $reisdent_item['TEL']; ?></td>

                    <td><?php echo $reisdent_item['NAME11']; ?></td>
                    <td><?php echo $reisdent_item['NAME22']; ?></td>

                    <td><?php echo ($reisdent_item['PAYTYPE'] === '0') ? 'Cheque' : 'Autopay'; ?></td>
                    <td><?php echo ($reisdent_item['ISPRINT'] === '0') ? 'YES' : 'NO'; ?></td>
                    
                    
                </tr>
            <?php endforeach ?>
        <tbody>
    </table>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create); ?>">                
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('driver_create'); ?></button>
            </div>
        </div>
        <input type="hidden" name="item" value="driver"/>
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