<?php 

mb_internal_encoding('UTF-8');


$topics = [
  			'1' => 'Business',
        '2' => 'Technologies',
        '3' => 'Advertising',
        '4' => 'Marketing',
];
  
$pays = [
  	 		'1' => 'WebMoney',
        '2' => 'Яндекс.Деньги',
        '3' => 'PayPal',
        '4' => 'Credit Card',
];


if ($_POST) 
{
	if (!empty($_POST['selected_ids']))
	{
		foreach ($_POST['selected_ids'] as $id)
		{
			$file = '/home/kate.hostfl.ru/public_html/data/'.$id.'.txt';
			if (is_file($file))
			{
				if(strpos($file, '..') === false)
				{
					unlink($file);
          $deletef = $deletef.$file.' ; ';
          file_put_contents('filedelete.txt', $deletef, FILE_APPEND);
				}
			}
		}
	}
} 

$files = glob('data/*.txt');

$data = [];

foreach ($files as $file)
{
	//$id = str_replace('data/', '', $file);
	//$id = str_replace('.txt', '', $id);
  
	$id = basename($file, '.txt');

	$contents = file_get_contents($file);
	$contents = trim($contents);

	$lines = explode("\n", $contents);

	$username = '';
	$lastname = '';
	$phone = '';
	$email = '';
  $topic = '';
  $pay = '';
  $d = '';

	foreach ($lines as $line) 
	{
		$line = trim($line);
		$values = explode(':', $line);
		switch ($values[0])
		{
			case 'Username' :
				$username = $values[1];
				break;

			case 'Lastname' :
				$lastname = $values[1];
				break;

			case 'Phone' :
				$phone = $values[1];
				break;
      
      case 'Email' :
				$email = $values[1];
				break;
      
      case 'Topic' :
				$topicId = $values[1];
				break;
      
      case 'Payment method' :
				$payId = $values[1];
				break;
      
       case 'Date and Time' :
				$d = $values[1].':';
      	$d = $d.$values[2].':';
      	$d = $d.$values[3];
				break;
		}
	}
  
 foreach($topics as $topicsId => $topicName)
{
 		if ($topicsId==$topicId) {
     		$topic = $topicName;
   	}
 }
  
  foreach($pays as $paysId => $payName)
{
 		if ($payId==$paysId) {
     		$pay = $payName;
   	}
 }
  
  //$selectValues = $_POST['selected_ids'];
  //print_r($selectValues);
  
	$data[$id] = [
		'username' => $username,
		'lastname' => $lastname,
		'phone' => $phone,
    'email' => $email,
    'topic' => $topic,
    'pay' => $pay,
    'd' => $d,
	];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title> </title>
  <style>
    
    .input_it {
      width:40px;
      margin-right:15px;
    }
    
    .name_it {
      color: #E7A4A4;
      display:flex;
      align-items:center;
      font-size:20px;
    }
    
    .admin_form {
     font-family:inherit;
     color:white; 
    }
    
    .sel_id {
     font-family:inherit;
     margin-left:40px;
     height: 60px;
   	 width: 120px;
    }
    .admin_zone {
      color:white;
    }
    
  </style>
</head>

<body>
	<h1 class="admin_zone"> ADMIN ZONE </h1>

	<form method="POST" class="admin_form">
		<ul>
			<?php foreach ($data as $id => $item): ?>
				<li>
          <div class="name_it">
					<input type="checkbox" class="input_it" name="selected_ids[]" value="<?= $id ?>">
					<strong> <?= $id ?> </strong>
          </div>
					Username: <?= $item['username'] ?> <br>
					Lastname: <?= $item['lastname'] ?> <br>
					Phone: <?= $item['phone'] ?> <br>
					Mail: <?= $item['email'] ?> <br>
    			Topic: <?= $item['topic'] ?> <br>
    			Payment method: <?= $item['pay'] ?> <br>
    			Date and time: <?= $item['d'] ?> <br>
				</li>
				<?php endforeach ?>
			</ul>
      <br>
			<button class="sel_id" type = "submit"> DELETE SELECTED </button>
		</form>
	</body>
	</html>
