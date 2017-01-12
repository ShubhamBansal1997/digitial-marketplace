</div>
<!-- content section end -->
<input type="hidden" id="basepath" value="<?php echo $basepath;?>" />
<!--Script_start-->
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/bootstrap.js"></script>
<?php if(isset($useColor)) { ?>
    <script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/jscolor.min.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/wow.js"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Dropzone -->
<link href="<?php echo $basepath;?>adminassets/js/dropzone/dropzone.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $basepath;?>adminassets/js/dropzone/dropzone.js" type="text/javascript"></script>
<!-- Dropzone -->
<script src="<?php echo $basepath;?>adminassets/js/admin_custom.js" type="text/javascript"></script>
</body>
</html>
