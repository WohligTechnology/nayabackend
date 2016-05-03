<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create collection</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createcollectionsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="image">image</label>
<input type="text" id="image" name="image" value='<?php echo set_value('image');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="description" class="materialize-textarea" length="400"><?php echo set_value( 'description');?></textarea>
<label>description</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="facebook">facebook</label>
<input type="text" id="facebook" name="facebook" value='<?php echo set_value('facebook');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="instagram">instagram</label>
<input type="text" id="instagram" name="instagram" value='<?php echo set_value('instagram');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="pinterest">pinterest</label>
<input type="text" id="pinterest" name="pinterest" value='<?php echo set_value('pinterest');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewcollection"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
