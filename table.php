<?php
	echo '<table class="table">';

	for ($i=0; $i<10; $i++) {
    echo '<tr class="tablestr">';
        for ($j=0; $j<10; $j++) {
                if ($i==$j) {
                    echo '<td class="tableel middle">' .(($i+1)*($j+1)). '</td>';
                } else {
                    echo '<td class="tableel">' .(($i+1)*($j+1)). '</td>';
                }
        }
     echo '</tr>';
	}
	
	echo '</table>';
?>
