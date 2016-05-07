<div class="row">
<div class="col s12">
<h4 class="pad-left-15">Create Homeslide</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createhomeslidesubmit");?>' enctype= 'multipart/form-data'>
<!-- <div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div> -->

<!-- <div class="row">
    <div class="col s12 m6">
        <label>Description</label>
        <textarea class="materialize-textarea"  name="description" placeholder="Enter text ...">
            <?php echo set_value('description');?>
        </textarea>
    </div>
</div>


<div class="row">
<div class="input-field col s6">
<label for="Link">Link</label>
<input type="text" id="Link" name="link" value='<?php echo set_value('link');?>'>
</div>
</div> -->
<div class="row">
<div class="input-field col s6">
<label for="Link">Order</label>
<input type="text" id="sorder" name="sorder" value='<?php echo set_value('sorder');?>'>
</div>
</div>
<!-- <div class="row">
<div class="input-field col s6">
<label for="Target">Target</label>
<input type="text" id="Target" name="target" value='<?php echo set_value('target');?>'>
</div>
</div> -->
 <!-- <div class="row">
            <div class="input-field col s12 m8">
                <?php echo form_dropdown('status', $status, set_value('status')); ?>
                 <label>Status</label>
            </div>
        </div> -->
<div class="row">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image</span>
<input type="file" name="image" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('image');?>'>
</div>
</div>
<span style="display:inline-block; margin-top:30px;">2000 X 867</span>
</div>
    <!-- <span style="color: blue;
    font-size: x-large;
    padding-left: 14px;">Button</span>
<div class="row">
<div class="input-field col s6">
<label for="Template">Template</label>
<input type="text" id="Template" name="template" value='<?php echo set_value('template');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Class">Class</label>
<input type="text" id="Class" name="class" value='<?php echo set_value('class');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Text">Text</label>
<input type="text" id="Text" name="text" value='<?php echo set_value('text');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Center Align">Center Align</label>
<input type="text" id="Center Align" name="centeralign" value='<?php echo set_value('centeralign');?>'>
</div>
</div> -->
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewhomeslide"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
