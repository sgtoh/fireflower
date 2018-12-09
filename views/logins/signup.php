<?php $this->setLayoutVar('title','新規登録'); ?>

<a href="<?php echo $base_url; ?>/home"><image id="modezero" src="<?php echo $base_url; ?>/../images/testbanner.png" ></a>
	<h2 id="start_h2">新規登録はこちらから</h2>
	<?php if(isset($errors)&&count($errors)>0): ?>
	<?php foreach($errors as $value) :?>
		<li><?php echo $this->escape($value);?></li>

	<?php endforeach ;?>
	<?php endif; ?>
	<div class="loginform"  >
		
		<form action="<?php echo $base_url; ?>/logins/register" method="post">
			<input type="hidden" name="_token" value="<?php echo $this->escape($_token)?>" />
			<table>
				<tbody>
					<tr>
						<td>お名前</td>
						<th><input type="text" name="user_name"></th>
                    </tr>
                    <tr>
						<td>パスワード</td>
						<th><input type="password" name="password"></th>
                    </tr>
                    <tr>
                    	<td>性別</td>
                        	<th>
                            	<input type="radio" name="gender" value="1">男性
                                <input type="radio" name="gender" value="2">女性
                            </th>
                    </tr>
                    
				</tbody>
			</table>
			<input type="submit" >
		</form>
	</div>
	
	