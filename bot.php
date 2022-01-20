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
require "modul.php";
require "site.php";

class Bot extends Modul{
	public function H1(){
		$cookie=$this->Save('Cookie');
		$user_agent=$this->Save('User_Agent');
		$h[]="cookie: ".$cookie;
		$h[]="user-agent: ".$user_agent;
		return $h;
	}
	public function head($cok,$user){
		$h[]="cookie: ".$cok;
		$h[]="user-agent: ".$user;
		return $h;
	}
	public function _run(){
		error_reporting(0);
		$api = json_decode(file_get_contents("http://ip-api.com/json"),1);
		$zone = $api["timezone"];
		if($zone){
			date_default_timezone_set($zone);
		}
		self::bn();
		global $user_agent;
		
		ulang:
		global $data;
		foreach($data as $base){
			$url = $base["host"];
			$cookie = $base["cookie"];
			
			$sesi="https://".$url."/session/autofaucet";
			$r1=$this->Run($sesi,$this->head($cookie,$user_agent),true);
		
			$err=trim(explode('</div>',explode('<div class="AutoACell AAC-error">',$r1)[1])[0]);
			if($err=='Insufficient balance to claim rewards.'){echo $this->col($err,"m")."\n";self::line();}
          
			if(preg_match('/FaucetPay/',$r1)){
				$pay=$this->col('fp',"b");
			}elseif(preg_match('/ExpressCrypto/',$r1)){
				$pay=$this->col('ec',"m");
			}elseif(preg_match('/Balance/',$r1)){
				$pay=$this->col('bl',"p");
			}elseif(preg_match('/Coinbase/',$r1)){
				$pay=$this->col('cb',"b");
			}else{
				$pay=null;
			}
			$coin1=trim(explode('</div>',explode('<i class="fas fa-coins"></i>',$r1)[1])[0]);
			preg_match_all('#<div class="AutoACell AAC-success">(.*?)<a#is',$r1,$ss);
			if($coin1){
				echo "Host: ".$this->col($url,"c")."\n";
				echo $this->col($coin1,"k")."\n";
			}else{
				echo $this->col("Tokens Tidak Terdeteksi","m")."\n";self::line();}
			if($ss[1]){
				echo $pay.$this->col("->","p");
				for($i=0;$i<count($ss[1]);$i++){
					$r=str_replace('Successfully sent','',$ss[1][$i]);
					$s=str_replace('Successfully added','',$r);
					$t=str_replace(' to your','',$s);
            		echo $this->col(trim($t),"h").",";
				}
			}
			echo "\n";
        	self::line();
		}$this->tmr(60);goto ulang;
	}
}
$play = new Bot();
$play -> _run();