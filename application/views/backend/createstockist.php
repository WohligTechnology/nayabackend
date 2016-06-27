<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create stockist</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createstockistsubmit");?>' enctype= 'multipart/form-data'>
  <div id="drp" class="row">
             <div class="input-field col s12 m8">
                 <?php echo form_dropdown('city', $city, set_value('city')); ?>
                  <label>city</label>
             </div>
             <div id="addbtn" class="btn blue darken-4" style="margin-top:25px;">
               <span>ADD</span>

             </div>
         </div>
         <script>
         $(document).ready(function(){
             $("#addbtn").click(function(){
                 $("#drp").hide();
             });
             $("#addbtn").click(function(){
                 $("#txt").show();
             });
         });
         </script>
<div id="txt" class="row" style="display:none;">
<div class="input-field col s6">
<label for="name">city</label>
<input type="text" id="city" name="citytxt" value='<?php echo set_value('citytxt');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="name">link</label>
<input type="text" id="link" name="link" value='<?php echo set_value('link');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="name">title</label>
<input type="text" id="name" name="title" value='<?php echo set_value('title');?>'>
</div>
</div>


<div class="row">
  <label>address</label>
<div class="input-field col s12">
<textarea id="some-textarea" name="address" class="materialize-textarea" length="400"><?php echo set_value( 'address');?></textarea>

</div>
</div>
 <div class="row">
<div class="input-field col s6">
<label for="facebook">phone</label>
<input type="text" id="phone" name="phone" value='<?php echo set_value('phone');?>'>
</div>
</div>
 <div class="row">
<div class="input-field col s6">
<label for="facebook">fax</label>
<input type="text" id="fax" name="fax" value='<?php echo set_value('fax');?>'>
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
