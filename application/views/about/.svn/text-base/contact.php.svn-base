<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-contact-us.png') top left no-repeat;"></div>

<p>If you have any questions or comments regarding the website or DC Universe Online,<br />
 feel free to fill out the form below and we'll get back to you as soon as possible.</p>

<div id="contact-us">
	<?php if (isset($contact_sent)) { ?>
	<div class="success">
		<p>Message sent successfully.</p>
	</div>
	<?php } ?>
	<?=form_open('contact-us')?>
	<div class="validation-errors">
		<?=validation_errors();?>
	</div>
	<div class="form-item input">
		<label for="email">Your Email</label> <input type="text" name="email" id="email" value="<?=$this->session->userdata('email')?>" />
	</div>
	<div class="form-item select">
		<label for="reason">What is this in regards to?</label>
		<select name="reason" id="reason">
			<option value="News Tip">News Tip</option>
			<option value="Technical Issue">Technical Issue</option>
			<option value="Other">Other</option>
		</select>
	</div>
	<div class="form-item textarea">
		<label for="describe">Please fill in a message...</label>
		<textarea name="describe" id="describe" cols="10" rows="5"></textarea>
	</div>
	<div class="form-item form-submit">
		<input type="submit" name="submit" id="submit" value="Send Message" />
	</div>
	</form>
</div>