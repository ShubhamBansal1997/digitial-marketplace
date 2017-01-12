  
<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
<div class="theme_page">
    <div class="theme_panel_section">
                    <h4 class="th_title">
                    <?php echo $this->ts_functions->getlanguage('aphead2text','vendorboard','solo');?>
                    </h4>
                <div class="th_content_section">
<input type="hidden" value="<?php echo $prod_details[0]['prod_id'];?>" id="prod_id" />
<input type="hidden" value="<?php echo $prod_details[0]['prod_type'];?>" id="prod_type" />

<div class="alert alert-info th_setting_text">
	<p><i style="color:#34c309;" class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('uploadtext','vendorboard','solo');?> </p>
</div>


	<div class="form-group">
    	<div class="col-lg-12 col-md-12">
    		
			<div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label> <?php echo $this->ts_functions->getlanguage('selectfiletext','vendorboard','solo');?> </label>
				</div>
				
				<div class="col-lg-6 col-md-6">
					<select class="form-control productfields" id="file_upload_type">
						<option value="Preview.jpg@#jpg,jpeg"><?php echo $this->ts_functions->getlanguage('previewimghelptext','vendorboard','solo');?></option>
					<?php if( $prod_details[0]['prod_type'] == 'Audio' ) { ?>
						<option value="Preview.mp3@#mp3"><?php echo $this->ts_functions->getlanguage('audiodemohelptext','vendorboard','solo');?></option>
					<?php } elseif( $prod_details[0]['prod_type'] == 'Video' ) { ?>
						<option value="Preview.mp4@#mp4"><?php echo $this->ts_functions->getlanguage('videodemohelptext','vendorboard','solo');?></option>
					<?php } elseif( $prod_details[0]['prod_type'] == 'Text' ) { ?>
						<option value="Preview.zip@#zip"><?php echo $this->ts_functions->getlanguage('textdemohelptext','vendorboard','solo');?></option>
					<?php } elseif( $prod_details[0]['prod_type'] == 'Other' ) { ?>
						<option value="Preview.zip@#zip"><?php echo $this->ts_functions->getlanguage('otherdemohelptext','vendorboard','solo');?></option>
					<?php } ?>
						<option value="Product.zip@#zip"> <?php echo $this->ts_functions->getlanguage('finalprodhelptext','vendorboard','solo');?></option>
						
					</select>                            
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label><?php echo $this->ts_functions->getlanguage('uploadtext','vendorboard','solo');?> </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="dropzone dz-clickable" id="tp_upload_section" style="min-height: 100px;border: 2px dashed #6f5499;text-align: center;">
						<div class="dz-default dz-message">
							<i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 40px;"></i>
							<p class="info_text"><?php echo $this->ts_functions->getlanguage('dropzonetext','vendorboard','solo');?></p>
						</div>
					</div>                       
				</div>
			</div>
			
						
			<p style="text-align: center;color: red;font-size: 16px;font-weight: bold;"> <?php echo $this->ts_functions->getlanguage('ortext','vendorboard','solo');?> </p>
			
			<div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label><?php echo $this->ts_functions->getlanguage('pasteimgtext','vendorboard','solo');?> </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<input type="text" class="form-control" id="paste_thumbnail" placeholder="https://">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-3 col-md-3">
					
				</div>
				<div class="col-lg-6 col-md-6" style="text-align: center;">
					<img src="" id="show_thumbnail" style="width: 300px;" class="thumbsec hideme">
					<br/><br/>
					<a class="btn theme_btn" onclick='use_paste_image();' class="thumbsec hideme"><?php echo $this->ts_functions->getlanguage('useimgtext','vendorboard','solo');?></a>
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12">
				<div class="th_btn_wrapper">
					<a class="btn theme_btn" onclick='window.location.href = "<?php echo $basepath;?>vendorboard/manage_products"'><?php echo $this->ts_functions->getlanguage('completebtn','vendorboard','solo');?></a>
				</div>
			</div>
    	
    	</div>
	</div>
						
					
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
	
<input type="hidden" id="cancelbtntext" value="<?php echo $this->ts_functions->getlanguage('cancelbtntext','vendorboard','solo');?>">
<input type="hidden" id="uploadcanceltext" value="<?php echo $this->ts_functions->getlanguage('uploadcanceltext','vendorboard','solo');?>">
<input type="hidden" id="extensionerror" value="<?php echo $this->ts_functions->getlanguage('extensionerror','vendorboard','solo');?>">
<input type="hidden" id="uploadsuctext" value="<?php echo $this->ts_functions->getlanguage('uploadsuctext','vendorboard','solo');?>">
<input type="hidden" id="uploaderrortext" value="<?php echo $this->ts_functions->getlanguage('uploaderrortext','vendorboard','solo');?>">
			
<input type="hidden" id="preverrortext" value="<?php echo $this->ts_functions->getlanguage('preverrortext','vendorboard','solo');?>">
<input type="hidden" id="importsuctext" value="<?php echo $this->ts_functions->getlanguage('importsuctext','vendorboard','solo');?>">
<input type="hidden" id="importfailedtext" value="<?php echo $this->ts_functions->getlanguage('importfailedtext','vendorboard','solo');?>">
<input type="hidden" id="imgtypeerrortext" value="<?php echo $this->ts_functions->getlanguage('imgtypeerrortext','vendorboard','solo');?>">
