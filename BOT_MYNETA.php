<?php
/*Bot Deployed on site: www.myneta.info */
	$ch=curl_init();
	set_time_limit(0);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch,CURLOPT_USERAGENT," Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36 ");
	curl_setopt($ch,CURLOPT_URL,"http://myneta.info/goa2012/index.php?action=show_winners&sort=default");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$page=curl_exec($ch);
	$candidates=explode("candidate_id=",$page);
	$candidate_keys=[];
	$count=0;$flag=0;
	foreach($candidates as $i){
		if($count==0){
			$count++;
			continue;
		}
		$key=explode(">",$i);
		$candidate_keys[]=$key[0];
	}
	$dbh=mysqli_connect("localhost","root","","kyc");
	foreach($candidate_keys as $j){
		$ch=curl_init();
		set_time_limit(0);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch,CURLOPT_USERAGENT," Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36 ");
		curl_setopt($ch,CURLOPT_URL,"http://myneta.info/goa2012/candidate.php?candidate_id=$j");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$page=curl_exec($ch);
		$z=explode("style='background:khaki;'>",$page);
		$html_info=explode('<div class="grid_3 omega">',$z[1]);
		$info=strip_tags($html_info[0]);
		$x=explode("(Winner)",$info,2);
		$name=trim($x[0]);
		$y=explode("Party:",$x[1],2);
		$constituency=trim($y[0]);
		$z=explode("S/o|D/o|W/o:",$y[1],2);
		$party=trim($z[0]);
		$xx=explode("Age:",$z[1],2);
		$care_of=trim($xx[0]);
		$yy=explode("Address:",$xx[1],2);
		$age=trim($yy[0]);
		/*$xxx=explode("Email:",$zz[1],2);
		$name_enrolled=trim($xxx[0]);
		$yyy=explode("Contact Number:",$xxx[1],2);
		$mail=trim($yyy[0]);*/
		$zzz=explode("Self Profession:",$yy[1],2);
		$address=trim($zzz[0]);
		$xyz=explode("Spouse Profession:",$zzz[1],2);
		$self_profession=trim($xyz[0]);
		$ass=explode("facebook",$xyz[1],2);
		$spouse_profession=trim($ass[0]);
		$qry="insert into goa values('$name','$constituency','$party','$care_of','$age','$address','$self_profession','$spouse_profession')";
		mysqli_query($dbh,$qry);
	}
	?>
