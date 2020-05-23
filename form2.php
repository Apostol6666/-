<?php

mb_internal_encoding('UTF-8');

//include 'config.php';
$errors = array('username'=>'', 'lastname'=>'', 'email'=>'','phone'=>'', 'topic'=>'', 'pay'=>'');

if($_POST) 
{

	foreach ($_POST as $key => $value) 
	{	
    if ($value != '') {
      str_replace(PHP_EOL, '||', $value);
    	$_POST[$key] = trim($value);
    }
	}

	if (empty($_POST['username'])) 
	{
		$errors['username'] = 'Username is required';
	}
	else if (mb_strlen($_POST['username']) < 3) 
	{
		$errors['username'] = 'Username must be more than 3 symbols';
	}
		else if (mb_strlen($_POST['username']) > 100) 
	{
		$errors['username'] = 'Username must be less than 100 symbols';
	}

	if (empty($_POST['lastname']))
	{
		$errors['lastname'] = 'Lastname is required!';
	}
		else if (mb_strlen($_POST['lastname']) > 100) 
	{
		$errors['lastname'] = 'Lastname must be less than 100 symbols';
	}
  
  	if (empty($_POST['phone']))
	{
		$errors['phone'] = 'Phone is required!';
	}
  else if (mb_strlen($_POST['phone']) < 10) 
	{
		$errors['phone'] = 'Phone must be more than 10 symbols';
	}
		else if (mb_strlen($_POST['phone']) > 20) 
	{
		$errors['phone'] = 'Phone must be less than 20 symbols';
	}
  
  	if (empty($_POST['email'])) 
	{
		$errors['email'] = 'Email is required';
	}
	else if (mb_strlen($_POST['email']) < 3) 
	{
		$errors['email'] = 'Email must be more than 3 symbols';
	}
		else if (mb_strlen($_POST['email']) > 40) 
	{
		$errors['email'] = 'Email must be less than 40 symbols';
	}
  
	if (empty($_POST['topic'])) 
	{
		$errors['topic'] = 'Topic is required!';
	}
  
  if (empty($_POST['pay'])) 
	{
		$errors['pay'] = 'Payment method is required!';
	}


	if ($errors['username']=='' && $errors['lastname']=='' && $errors['email']=='' && $errors['phone']=='' && $errors['topic']=='' && $errors['pay']=='')
	{
		$username = $_POST['username'];
		$lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
		$topic = $_POST['topic'];
    $pay = $_POST['pay'];
		$d = date('d-m-Y | h:i:sa ');
    $user_id = getenv('REMOTE_ADDR');
    $state = 0;

		$content = [];
    $content[] = $user_id;
		$content[] = $d;
    $content[] = $username;
		$content[] = $lastname ;
    $content[] = $phone;
    $content[] = $email; 
		$content[] = $topic;
		$content[] = $pay;
    $content[] = $state;

	  $filename = 'data.txt';
    
    $content = implode('  ||  ', $content) . PHP_EOL;
		
		file_put_contents($filename, $content, FILE_APPEND);

		//header('Location: /result.php');
		//exit;

		$successMessage = 'Спасибо, ваши данные сохранены';
	}
}


?>

<!DOCTYPE html>
<head>
	<title> From </title>
  <style>
  .forma {
      margin: 0 auto;
      text-align:center;
    }
    

  .error {
      color: red;
    }

  label {
      font-size: 20px; 
      color: #E7A4A4;
  }
    
  input, select {
    font-family:inherit;
    margin-top:20px;
    margin-bottom:20px;
    height:35px;
    width:200px;
    font-size:20px;
  }
  
  .checkbox {
    height:22px;
    width:22px;
    margin-right:5px;
  }
  
  .check {
  display: flex;
  align-items: center;
  margin:0 auto;
  justify-content: center;
  }
    
  .gobutt {
    height:20px;
    width:80px;
  }
    
  </style>
     
</head>
<body>

<?php if (!empty($successMessage)): ?>

		<p><?= $successMessage ?></p>

<?php else: ?>
	<?php if ($errors['username']=='' && $errors['lastname']=='' && $errors['email']=='' && $errors['phone']=='' && $errors['topic']=='' && $errors['pay']==''): ?>
			<p class="error_message"> <strong> Validation errors encountered! </strong></p>
	<?php endif; ?>
<?php endif; ?>


<form class="forma" method="POST" action="" novalidate="">
	<div class="form-group">
    <label> Firstname </label>
    <br>
		<input type="text" name="username" required value="<?= !empty($_POST['username']) ? $_POST['username'] : '' ?>">
    <br>
		<span class="error"><?= $errors['username'] ?></span>
	</div>

	<div class="form-group">
		<label> Lastname </label>
    <br>
		<input type="text" name="lastname" required value="<?= !empty($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
    <br>
		<span class="error"><?= $errors['lastname'] ?></span>
	</div>
  
  <div class="form-group">
		<label> Phone </label>
    <br>
		<input type="text" name="phone" required value="<?= !empty($_POST['phone']) ? $_POST['phone'] : '' ?>">
    <br>
		<span class="error"><?= $errors['phone'] ?></span>
	</div>
  
  <div class="form-group">
		<label> Mail </label>
    <br>
		<input type="text" name="email" required value="<?= !empty($_POST['email']) ? $_POST['email'] : '' ?>">
    <br>
		<span class="error"><?= $errors['email'] ?></span>
	</div>

	<div class="form-group">
		<label> Topic </label>
    <br>
		<select name="topic">
			<option value="">--</option>
      <option value="1"<?= !empty($_POST['topic']) && $_POST['topic']==='1' ? 'selected' : '' ?>> Business </option>
      <option value="2"<?= !empty($_POST['topic']) && $_POST['topic']==='2' ? 'selected' : '' ?>> Technologies </option>
      <option value="3"<?= !empty($_POST['topic']) && $_POST['topic']==='3' ? 'selected' : '' ?>> Advertising </option>
      <option value="4"<?= !empty($_POST['topic']) && $_POST['topic']==='4' ? 'selected' : '' ?>> Marketing </option>
		</select>
    <br>
		<span class="error"><?= $errors['topic'] ?></span>
	</div>

	<div class="form-group">
		<label> Payment method </label>
    <br>
		<select name="pay">
			<option value="">--</option>
      <option value="1"<?= !empty($_POST['pay']) && $_POST['pay']==='1' ? 'selected' : '' ?>> WebMoney</option>
      <option value="2"<?= !empty($_POST['pay']) && $_POST['pay']==='2' ? 'selected' : '' ?>> Яндекс.Деньги</option>
      <option value="3"<?= !empty($_POST['pay']) && $_POST['pay']==='3' ? 'selected' : '' ?>> PayPal</option>
      <option value="4"<?= !empty($_POST['pay']) && $_POST['pay']==='4' ? 'selected' : '' ?>> Credit Card</option>
		</select>
    <br>
		<span class="error"><?= $errors['pay'] ?></span>
	</div>

	<div  class="check"> 
      <br>
			<input type="checkbox" class="checkbox" name="agree" <?= !empty($_POST['agree']) ? ' checked' : '' ?>>
			<label> I want to receive news by email </label>
	</div>

		<button class="gobutt" type="submit">  </button>
</form>

</body>
</html>
