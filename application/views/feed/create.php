<?php $this->load->view('inc/header'); ?>

<h1>Create Custom Feed</h1>

<div class="well">
<?php
echo form_open('feed/create');

echo form_fieldset('Feed Information');

echo form_error('name');
echo form_label('Feed Name', 'name');
echo form_input('name');

echo form_fieldset_close(); 

echo form_button(array('id' => 'submit', 'value' => 'Add', 'name' => 'submit', 'type' => 'submit', 'content' => 'Add','class' => 'btn btn-primary'));
?>
 <a href="<?php echo site_url('feed'); ?>" class="btn">Cancel</a>
<?php
echo form_close();
?>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('form:not(.filter) :input:visible:first').focus();
});
</script>

<?php $this->load->view('inc/footer'); ?>
