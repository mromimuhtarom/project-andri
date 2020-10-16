<?php 
function cutText($text, $length, $mode = 2)
{
	if ($mode != 1)
	{
		$char = $text{$length - 1};
		switch($mode)
		{
			case 2: 
				while($char != ' ') {
					$char = $text{--$length};
				}
			case 3:
				while($char != ' ') {
					$char = $text{++$num_char};
				}
		}
  }
  $countcharacter = strlen($text);
  if($countcharacter > $length):
    $dot = '...';
  else: 
    $dot = '';
  endif;
	return substr($text, 0, $length).$dot;
}
?>