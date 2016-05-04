<div class="row">
<div class="col s12">
<h4 class="pad-left-15">Edit Homeslide</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/edithomeslidesubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<!-- <div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div> -->

<!-- <div class="row">
    <div class="col s12 m6">
        <label>Description</label>
        <textarea class="materialize-textarea"  name="description" placeholder="Enter text ...">
            <?php echo set_value('description',$before->description);?>
        </textarea>
    </div>
</div>


<div class="row">
<div class="input-field col s6">
<label for="Link">Link</label>
<input type="text" id="Link" name="link" value='<?php echo set_value('link',$before->link);?>'>
</div>
</div> -->

<div class="row">
<div class="input-field col s6">
<label for="Link">Order</label>
<input type="text" id="sorder" name="sorder" value='<?php echo set_value('sorder',$before->sorder);?>'>
</div>
</div>
<!-- <div class="row">
<div class="input-field col s6">
<label for="Target">Target</label>
<input type="text" id="Target" name="target" value='<?php //echo set_value('target',$before->target);?>'>
</div>
</div> -->
 <!-- <div class="row">
            <div class="input-field col s12 m8">
                <?php echo form_dropdown('status', $status, set_value('status',$before->status)); ?>
                 <label>Status</label>
            </div>
        </div> -->

<div class="row">
			<div class="file-field input-field col m6 s12">
				<span class="img-center big image1">
                   			<?php if ($before->image == '') {
} else {
    ?><img src="<?php echo base_url('uploads').'/'.$before->image;
    ?>">
						<?php
} ?></span>
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate image1" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image', $before->image);?>">
				</div>
<!--				<div class="md4"><a class="waves-effect waves-light btn red clearimg input-field ">Clear Image</a></div>-->
			</div>
<span style="display:inline-block; margin-top:240px;">2000 X 867</span>
		</div>
<!-- <div class="row">
<div class="input-field col s6">
<label for="Template">Template</label>
<input type="text" id="Template" name="template" value='<?php //echo set_value('template',$before->template);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Class">Class</label>
<input type="text" id="Class" name="class" value='<?php //echo set_value('class',$before->class);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Text">Text</label>
<input type="text" id="Text" name="text" value='<?php //echo set_value('text',$before->text);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Center Align">Center Align</label>
<input type="text" id="Center Align" name="centeralign" value='<?php //echo set_value('centeralign',$before->centeralign);?>'>
</div>
</div> -->
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewhomeslide"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
