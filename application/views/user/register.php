<div class="content-heading content-heading-replacer round-top-left" style="background: url('/assets/images/title-left-register.png') top left no-repeat;"></div>
                    
<div class="content-bg-superman">
    <div id="register">
        <?php if (validation_errors() != "") { ?>
        <div id="validation-errors">
            <?=validation_errors();?>
        </div>
        <?php } ?>
        <?=form_open('register');?>
        <div class="form-item input">
            <label for="username">Pick a Username</label> <input type="text" name="username" id="username" value="<?=set_value('username')?>" />
        </div>
        <div class="form-item input">
            <label for="password">Enter a Password</label> <input type="password" name="password" id="password" />
        </div>
        <div class="form-item input">
            <label for="pass_conf">Re-Enter the Password</label> <input type="password" name="pass_conf" id="pass_conf" />
        </div>
        <div class="form-item input">
            <label for="email">Enter your Email Address</label> <input type="text" name="email" id="email" value="<?=set_value('email');?>" />
        </div>
        <div class="form-item">
            <label>Enter the Text you see below</label>
            <div style="float: left;">
            	<?=$recaptcha?>
            </div>
        </div>
        <div class="form-submit">
            <input type="submit" name="submit" id="submit" value="Register" />
        </div>
    </div>
    
    <div id="register-why">
    	<h3>Why Register?</h3>
        <ul>
        	<li>Participate in discussions over the latest DCUO news.</li>
            <li>Ask questions or assist other players with alerts and raids.</li>
            <li>Find and meet other DCUO players.</li>
        </ul>
    </div>
    
</div>