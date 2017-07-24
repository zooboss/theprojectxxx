<?php 

function GenUnicPass ($length=18) 
	 {
     $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP-_+=*/[]{}?!@#$%^&";
     $length = intval($length);
     $size=strlen($chars)-1;
     $UnicPass = "";
     while($length--) $UnicPass.=$chars[rand(0,$size)];
	 return $UnicPass;
	 }	
	

  

 



	
?>


	