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

function iconsorting($fieldname)
{
  if(isset($_GET['namecolumn'])):
    if($_GET['namecolumn'] === $fieldname):
      if($_GET['sorting'] === 'asc'):
        $icon = '-up';
      else:
        $icon = '-down';
      endif;
    else:
      $icon = '';
    endif;
  else:
    $icon = '';
  endif;

  return $icon;
}

function curlApirajaongkir($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 4d6444a58c240d9ed1038a8891738950"
        ),
    ));

    return $curl;
}

function apiProvince($param) {
  if($param != NULL): 
    $param = "?".$param;
  else: 
    $param = '';
  endif;
  $url      = "https://api.rajaongkir.com/starter/province".$param;
  $curl     = curlApirajaongkir($url);
  $response = curl_exec($curl);
  $err      = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return json_decode($response);
  } 
}

function apiCity($param)
{
  if($param != NULL): 
      $param = "?".$param;
  else: 
      $param = '';
  endif;
  $url      = "https://api.rajaongkir.com/starter/city".$param;
  $curl     = curlApirajaongkir($url);
  $response = curl_exec($curl);
  $err      = curl_error($curl);

  curl_close($curl);

  if ($err) {
  return "cURL Error #:" . $err;
  } else {
  return json_decode($response);
  }        
}

?>