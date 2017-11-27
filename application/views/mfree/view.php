

<?php $mode_create = array('mfree', 'create'); ?>
<?php $mode_edit = array('mfree', 'edit'); ?> 

<div class="container-fluid">    
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#"><?php echo $this->lang->line('menu03'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('menu032'); ?></li>
    </ol>
</div>


<div class="container-fluid">
    <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
        <thead>
            <tr>
                <td><?php echo $this->lang->line('mfree_code'); ?></td>
                <td><?php echo $this->lang->line('mfree_description'); ?></td>
                <td><?php echo $this->lang->line('mfree_unit'); ?></td>
                <td><?php echo $this->lang->line('mfree_free'); ?></td>
                <td><?php echo $this->lang->line('mfree_eff_date'); ?></td>
            </tr>
        </thead>
        <tbody>             
            <?php foreach ($mfree as $mfree_item): ?>
                <tr>
                    <td>
                        <?php echo "<a href='" . site_url($mode_edit) . "/" . $mfree_item['SEQ'] . "'>" . $mfree_item['SEQ'] . " </a>"; ?>
                    </td>
                    <td><?php echo $mfree_item['DESCRIPTION']; ?></td>
                    <td><?php echo $mfree_item['UNIT']; ?></td>
                    <td><?php echo number_format($mfree_item['FEE'],2); ?></td>
                    <td><?php echo $mfree_item['EFF_DATE']; ?></td>

                </tr>
            <?php endforeach ?>
        <tbody>
    </table>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($mode_create); ?>">                
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo $this->lang->line('mfree_create'); ?></button>
            </div>
        </div>
        <input type="hidden" name="item" value="mfree"/>
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