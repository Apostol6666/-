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

if ($_POST['selected_ids']) 
{
	if (!empty($_POST['selected_ids']))
	{ 
		$contents = file_get_contents('data.txt');
		$contents = trim($contents);
    
    $new_content =[];
    
    $lines = explode("\n", $contents);
    
    foreach ($_POST['selected_ids'] as $id) {
      foreach ($lines as $line) {
        $line=trim($line);
        
        $col = explode('||', $line);
        if ($col[0] === $id) {
          $col[8] = 0;
      }
    }
	}
    file_put_contents('data.txt', implode("\n",$new_content), FILE_APPEND)."\n";
} 
}

  $file = 'data.txt';
	$contents = file_get_contents($file);
	$contents = trim($contents);

  $items = explode("\n", $contents);

  $data=[];

foreach ($items as $item) {
  
	$lines = explode("\n", $contents);
	
  $id='';
  $user_id = '';
	$username = '';
	$lastname = '';
	$phone = '';
	$email = '';
  $topic = '';
  $pay = '';
  $d = '';
  $state = '';
  
  $item = trim($item);
  $cols = explode(' || ', $item);
  
  $user_id = $cols[0];
  $d = $cols[1];
  $username = $cols[2];
  $lastname = $cols[3];
  $phone = $cols[4];
  $email = $cols[5];
  $topicId = $cols[6];
  $payId = $cols[7];
  $state = $cols[8];
 
  
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
  if($state!==0) {  
      $data[$id] = [
        'username' => $username,
        'lastname' => $lastname,
        'phone' => $phone,
        'email' => $email,
        'topic' => $topic,
        'pay' => $pay,
        'd' => $d,
        'user_id' => $user_id,
      ];
    }
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
    
    .name_it2 {
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
    
    table {
      border-spacing: 11px 11px;
    }
    
    td {
      font-family:inherit;
    }
    
  </style>
</head>

<body>
	<h1 class="admin_zone"> ADMIN ZONE </h1>

	<form method="POST" class="admin_form">
    <table>
      <thead>
        <strong><th> ID </th></strong>
      	<strong><th> Username </th></strong>
        <strong><th> Lastname </th></strong>
        <strong><th> Phone </th></strong>
        <strong><th> Mail </th></strong>
        <strong><th> Topic </th></strong>
        <strong><th> Payment method </th></strong>
        <strong><th> Date and Time </th></strong>
      </thead>
		<tbody>
			<?php foreach ($data as $id => $item): ?>
				<tr>
          <td>
          <div class="name_it2">
					<input type="checkbox" class="input_it" name="selected_ids" value="<?= $id ?>">
          <?= $item['user_id'] ?> 
          </div>
          </td>
          <td> <?= $item['username'] ?> </td>
					<td> <?= $item['lastname'] ?> </td>
					<td> <?= $item['phone'] ?> </td>
					<td> <?= $item['email'] ?> </td>
    			<td> <?= $item['topic'] ?> </td>
    			<td> <?= $item['pay'] ?> </td>
    			<td> <?= $item['d'] ?> </td>
				</tr>
				<?php endforeach ?>
			</tbody>
    </table>
      <br>
			<button class="sel_id" type = "submit" > DELETE SELECTED </button>
		</form>
	</body>
	</html>
