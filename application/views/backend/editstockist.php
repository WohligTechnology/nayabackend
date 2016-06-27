<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit stockist</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editstockistsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

<div class="row">
           <div class="input-field col s12 m8">
               <?php echo form_dropdown('city', $city, set_value('city',$before->city)); ?>
                <label>city
           </div>
       </div>
       <div class="row">
       <div class="input-field col s6">
       <label for="name">link</label>
       <input type="text" id="link" name="link" value='<?php echo set_value('link',$before->link);?>'>
       </div>
       </div>
       <div class="row">
       <div class="input-field col s6">
       <label for="name">title</label>
       <input type="text" id="title" name="title" value='<?php echo set_value('title',$before->title);?>'>
       </div>
       </div>
<div class="row">
<div class="col s12 m6">
<label>address</label>
<textarea id="some-textarea" name="address" placeholder="Enter text ..."><?php echo set_value( 'address',$before->address);?></textarea>
</div>
</div>

<div class="row">
<div class="input-field col s6">
<label for="facebook">phone</label>
<input type="text" id="phone" name="phone" value='<?php echo set_value('phone',$before->phone);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="facebook">fax</label>
<input type="text" id="fax" name="fax" value='<?php echo set_value('fax',$before->fax);?>'>
</div>
</div>

<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewstockist"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
