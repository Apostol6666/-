<?php

$examples = [
      '1zfilename' => 'newpicture.jpg',
      '2zarchive' => 'arch.zip',
      '2zmus' => 'mymusic.mp3',
      '2zvideo' => 'videofile.mov',
      '2zimg' => 'hellou.psd',
];
  
echo '<p>'. $examples['1zfilename'] .'</p>';

findexpansion($examples['1zfilename']);

echo '<p>'. $examples['2zarchive'] .'</p>';

echo '<p>';
findtype($examples['2zarchive']);
findtype($examples['2zmus']);
findtype($examples['2zvideo']);
findtype($examples['2zimg']);
echo '</p>';

echo '<strong><p>';
echo 'Find title in html : </strong>';
$html = file_get_contents('/home/kate.hostfl.ru/public_html/index.php');
findteg($html);
echo '</p>';

echo '<strong><p>';
echo 'Find links in html : </strong>';
findlink($html);
echo '</p>';

echo '<strong><p>';
echo 'Find image links in html : </strong>';
findimglink($html);
echo '</p>';

echo '<strong><p>';
echo 'Create strong TABLE </strong>';
strongstr($html);
echo '</p>';


echo '<strong><p>';
echo 'Find smiles </strong>';
findsmile($html);
echo '</p>';

echo '<strong>Delete space : </strong><br>';
deletespace();

?>

<?php
   function findexpansion($filename)
    	{
        $reg1 = '/^[A-Za-z\d\-\_]+[\~\#\%\&\*\{}\\\:\<\>\?\+\|\"]{0,}\.[A-Za-z\d]+$/';
        $reg2 = '/\.[A-Za-z\d]+$/';
        if (preg_match($reg1, $filename))
        {
          if (preg_match($reg2, $filename,$matches))
              {
                echo "\n"; 
                print_r ($matches);
              }
        }
    }

function findtype($filename) 
  {
    $reg1 = '/^[A-Za-z\d\-\_]+[\~\#\%\&\*\{}\\\:\<\>\?\+\|\"]{0,}\.[A-Za-z\d]+$/';
    $reg2 = '/\.[A-Za-z\d]+$/';
      $reg3 ='/zip|rar|arg|cab|tar|lzh|xar|7(z|-zip|apk|deb)/i';
      $reg4 = '/mp3|wav|aiff|ape|flac|ogg|mod|midi|cd|aac/i';
      $reg5 ='/mov|avi|pal|ntsc|secam|vhs|dv|avchd|mpeg(-[1234])*|hd|wmv|mkv|3gp|ra[m]*|rm|swf|flv|vob|ifo/i';
      $reg6 ='/psd\d*|img|raw|jpeg|jpg|tiff|bmp|gif|png/i';
        
     
        if (preg_match($reg1, $filename))
        {
          if (preg_match($reg2, $filename,$matches))
              {
            if (preg_match($reg3, $matches[0],$endmatch))
              	{
                	echo "<br>".$filename; 
                	echo " - It's archive! \n";
              	}
            if (preg_match($reg4, $matches[0],$endmatch))
              	{
                	echo "<br>".$filename; 
                	echo " - It's audiofile! \n";
              	}
            if (preg_match($reg5, $matches[0],$endmatch))
              	{
                	echo "<br>".$filename;  
                	echo " - It's videofile! \n";
              	}
            if (preg_match($reg6, $matches[0],$endmatch))
              	{
                	echo "<br>".$filename; 
                	echo " - It's image! \n";
              	}
              }
        }
  }

function findteg($html) {
  $reg1 = '/<title>(.+)<\/title>/';
  if ( preg_match($reg1, $html, $matches))
  {
    print('Title - '.$matches[1]);
  }
}

function findlink($html) {
  $reg1 = '/<\s*a\s*href\s*="(.+)"\s*>.*<\/a>/';
  if ( preg_match_all($reg1, $html, $matches))
  {
    print('Links  - ');
    foreach ($matches[0] as $match) 
    {
      $link = $match;
      echo $link.' ; ';
      }
  }
}

function findimglink($html) {
  $reg1 = '/<\s*img\s*src\s*="(.+)"\s*.*>/';
  if ( preg_match_all($reg1, $html, $matches))
  {
    print('Image Links  - ');
    foreach ($matches[1] as $match) 
    {
      $imglink = $match;
      echo $imglink.'<pre>     |||     </pre>';
      }
  }
}

function strongstr($html) {
  $reg = '/TABLE/';
  $pattern = '<strong class="light"> TABLE </strong>';
  $html = preg_replace($reg, $pattern, $html);
}

function findsmile($html) {
 //$reg1 =  '/<\s*img\s*src\s*=\s*"(((smile.png)"\s*alt=\s*"(:\))|((wink.png)"\s*alt=\s*"(;\))((sad.png)"\s*alt=\s*"(:\())"\s*>/';
  $reg1 = '/<\s*img\s*src\s*="(.+)"\salt\s*="\s*(.+)\s*".*>/';
  $reg2 = '/smile\.png\s*:\)|wink\.png\s*\;\)|sad.png\s*:\(/';
 if ( preg_match_all($reg1, $html, $matches))
  {
   print('Smiles  : ');
   for ($m=0;$m<count($matches[1]); $m++) 
   {
   			$matchName = $matches[1][$m];
     		$matchSmile = $matches[2][$m];
     		$allmatch = $matchName.$matchSmile;
     if (preg_match($reg2, $allmatch)) {
       print $matchName.' - '.$matchSmile. '<pre>     |||     </pre>';
     }
   }
  }
}

function deletespace() {
  $sp = "       	";
  $string = 'HI,'.$sp.'MY'.$sp.'DEAR'.$sp.'FRIEND!';
  echo '<p><pre>'.$string.'</p></pre>'.'<br>';
  $string = preg_replace('/(\s{2,})/',' ', $string);
  echo '<pre><p>'.$string.'</p></pre>';
   $a = (bool)(string)(int)'';
  echo $a;
}

?>
