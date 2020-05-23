<?php
    $eng=array('Help'=>'Помоги','me'=>'мне','I'=>'Я', 'see'=>'вижу','you'=>'тебя', 'Wait'=>'Жду', 'here'=>'здесь');
    $ru=array('Помоги'=>'Help.','мне'=>'me','Я'=>'I','вижу'=>'see','тебя'=>'you', 'Жду'=>'Wait', 'здесь'=>'here');
    $phrase='Help me. I see you. Wait you here.';
		echo '<p class="ph">'.$phrase.'</p> ';
		$phrase = preg_replace('/[.]/','', $phrase);
		$lang = $eng;
		function translate($lang, $phrase) {
       $words = explode(" ", $phrase);
       foreach($words as $word => $word_count) {
       echo $lang[$word_count].' ';
    }
}
echo '<p class="ph">';
translate($lang, $phrase);
echo '</p>';
?>
