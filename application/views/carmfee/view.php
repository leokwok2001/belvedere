<?php $mode_create = array('carmfee', 'create'); ?>
<?php $mode_edit = array('carmfee', 'edit'); ?> 

<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu04'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu041'); ?></li>
    </ol>
</div>

<div class="container-fluid">
    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
        <thead>
            <tr>
                <td><?php echo $this->lang->line('carmfee_code'); ?></td>
                <td><?php echo $this->lang->line('carmfee_fee'); ?></td>
                <td><?php echo $this->lang->line('carmfee_eff_date'); ?></td>
                <td><?php echo $this->lang->line('carmfee_type'); ?></td>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($carmfee as $carmfee_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $carmfee_item['SEQ'] . "'>" . $carmfee_item['SEQ'] . " </a>"; ?>
                    </td>
                    <td><?php echo number_format($carmfee_item['FEE'], 2); ?></td>
                    <td><?php echo $carmfee_item['EFF_DATE']; ?></td>
                    <td><?php echo $carmfee_item['CARPARK']; ?></td>
                </tr>
            <?php endforeach ?>
        <tbody>
    </table>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create); ?>">                
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('carmfee_create'); ?></button>
            </div>
        </div>
        <input type="hidden" name="item" value="carmfee"/>
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