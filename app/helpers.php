<?php

//check if a shop liked or not
function exlike($uid,$sid) {


  if (DB::table('likes')->where('u_id',$uid)->where('s_id',$sid)->exists() or DB::table('dislikes')->where('u_id',$uid)->where('s_id',$sid)->exists()) {

      return true ;


  }
  else {
    return false ;
  }

}

//delete all shop created 2 hours ago
function DelDislike() {
  $date = new DateTime;
$date->modify('-2 hours');
$formatted_date = $date->format('Y-m-d H:i:s');

    $del = DB::table('dislikes')->where('created_at', '<', $formatted_date)->delete();

    return $del;
}

//order by distance
function orderbydist($lat,$lng,$uid) {


    $obd = DB::table('shops')
    ->select('*')
		->addSelect(DB::raw('( 6371 * acos ( cos ( radians('.$lat.') ) * cos( radians(location_coordinates_1) ) * cos( radians(location_coordinates_0) - radians( ('.$lng.') ) ) + sin ( radians('.$lat.') ) * sin( radians(location_coordinates_1) ) ) ) as distance'  ))
		->orderByRaw('distance ASC')
		->get();

    $filtred = collect([]);


    foreach ($obd as $obd) {
      $sid = $obd->id_oid;
      if (exlike($uid,$sid) == false) {

        $filtred->push($obd);


      }
    }


    return $filtred;
}

//get geo informations for ip adress
function getlocation($ip) {




    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://ip-api.com/json/' . $ip
    ));
    if (!curl_exec($curl)) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }
    $resp = curl_exec($curl);

    curl_close($curl);

    $data = json_decode($resp);
    return $data;
}
