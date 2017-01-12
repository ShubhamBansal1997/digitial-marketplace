<!---- Editor dependent JS on TOP -------->
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/jquery-1.12.3.js"></script>
<?php $h_arr = explode('http://', $basepath);
	if( count($h_arr) == 2 ) {
?>
<script src="http://cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
<?php } else { ?>
<script src="https://cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
<?php } ?>
<!---- Editor dependent JS on TOP -------->

<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="theme_page">

        <div class="theme_panel_section">
            <div class="panel-group theme_panel" id="accordion" role="tablist" aria-multiselectable="true">
                <script>
                    var editorArr = ['default'];
                </script>
                <?php if(!empty($pageSection)) {
                $i=0;
                    foreach($pageSection as $solo_page) {
                    $i++;
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="<?php echo $i;?>">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion<?php echo $i;?>" aria-expanded="true" aria-controls="accordion<?php echo $i;?>" <?php echo ($i == 1) ? '' : 'class="collapsed"' ; ?> >
                                <?php echo ucfirst($solo_page['page_type']);?>
                            </a>
                        </h4>
                    </div>
                    <div id="accordion<?php echo $i;?>" class="panel-collapse collapse <?php echo ($i == 1) ? 'in' : '' ; ?>" role="tabpanel" aria-labelledby="<?php echo $i;?>">
                        <div class="panel-body">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Heading</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" id="page_headingV7<?php echo $i;?>"  class="form-control" value="<?php echo $solo_page['page_heading'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Content</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea id="page_contentV7<?php echo $i;?>" class="form-control"><?php echo $solo_page['page_content'];?></textarea>
                            </div>
                    </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePageContent(this)" data-type="<?php echo $solo_page['page_type'];?>" data-counter="<?php echo $i;?>" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <script>
                    var ed<?php echo $i;?> = CKEDITOR.replace( 'page_contentV7<?php echo $i;?>' , {
                    uiColor: '#6f5499'
                } );

                editorArr.push(ed<?php echo $i;?>);
                </script>
                <?php } } ?>

            </div>
        </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user content section -->
	</div>

<!------------ footer codes -------->

</div>
<!-- content section end -->
<input type="hidden" id="basepath" value="<?php echo $basepath;?>" />
<!--Script_start-->

<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/wow.js"></script>
<script src="<?php echo $basepath;?>adminassets/js/admin_custom.js" type="text/javascript"></script>

</body>
</html>
