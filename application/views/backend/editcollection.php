<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit collection</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editcollectionsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="name">name</label>
<input type="text" id="name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="image">image</label>
<input type="text" id="image" name="image" value='<?php echo set_value('image',$before->image);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>description</label>
<textarea name="description" placeholder="Enter text ..."><?php echo set_value( 'description',$before->description);?></textarea>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="facebook">facebook</label>
<input type="text" id="facebook" name="facebook" value='<?php echo set_value('facebook',$before->facebook);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="instagram">instagram</label>
<input type="text" id="instagram" name="instagram" value='<?php echo set_value('instagram',$before->instagram);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="pinterest">pinterest</label>
<input type="text" id="pinterest" name="pinterest" value='<?php echo set_value('pinterest',$before->pinterest);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewcollection"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
