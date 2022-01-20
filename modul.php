<?php
/*
*
*Creator	: iewil
*Github		: https://github.com/iewilmaestro
*Youtube	: https://www.youtube.com/c/iewil
*Telegram	: @iewil57
*Support	: Team-Function-INDO
*
*/
class Modul{
	public function Run($url, $httpheader = 0, $post = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		//curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_COOKIE,TRUE);
		//curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
		//curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
		if($post){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		if($httpheader){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
		}
		if($proxy){
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			//curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		}
		curl_setopt($ch, CURLOPT_HEADER, true);
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch);
		if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
			$header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			$body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			curl_close($ch);
			return array($header, $body)[1];
		}
	}
	public function col($str,$color){
		if($color==5){$color=['h','k','b','u','m'][array_rand(['h','k','b','u','m'])];}
		$war=array('rw'=>"\033[107m\033[1;31m",'rt'=>"\033[106m\033[1;31m",'ht'=>"\033[0;30m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'rr'=>"\033[101m\033[1;37m",'rg'=>"\033[102m\033[1;34m",'ry'=>"\033[103m\033[1;30m",'rp1'=>"\033[104m\033[1;37m",'rp2'=>"\033[105m\033[1;37m");return $war[$color].$str."\033[0m";
	}
	public function tmr($tmr){
		$timr=time()+$tmr;
		while(true){
			echo "\r                       \r";$res=$timr-time(); 
			if($res < 1){break;}
			echo $this->col(date('i:s',$res),"5");
			sleep(1);
		}
	}
	public function line(){
		$u="\033[1;35m";$h="\033[1;32m";$p="\033[1;37m";$m="\033[1;31m";$k="\033[1;33m";$b="\033[1;34m";$c="\033[1;36m";$len = 36;$var = $p.'─';
		echo str_repeat($var,$len)."\n";
	}
	public function bn(){
		system('clear');
		$u="\033[1;35m";$h="\033[1;32m";$p="\033[1;37m";$m="\033[1;31m";$k="\033[1;33m";$b="\033[1;34m";$c="\033[1;36m";
		$mp="\033[101m\033[1;37m";$cl="\033[0m";$mm="\033[101m\033[1;31m";$hp="\033[1;7m";
		$z=strtoupper('multi');$x=18;$y=strlen($z);$line=str_repeat('_',$x-$y);
		echo "\n{$m}[{$p}Script{$m}]->{$k}[".$h.$z."{$k}]-[".$h."1.0".$k."]".$p.$line.".\n";
		echo "{$u}.__              .__.__ 	    {$p}| \n";
		echo "{$u}|__| ______  _  _|__|  |	\n|  |/ __ \ \/ \/ /  |  |\n";
		echo "|  \  ___/\     /|  |  |__\n|__|\___  >\/\_/ |__|____/\n";
		echo "        \/\n";
		echo "{$mm}[{$mp}▶{$mm}]{$cl} {$k}https://www.youtube.com/c/iewil\n";
		echo "{$c}{$hp} >_{$cl}{$b} Team-Function-INDO\n";
		echo "{$p}────────────────────────────────────\n";
	}
}
