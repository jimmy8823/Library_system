<?php
	header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
    require_once('./PHPMailer/PHPMailerAutoload.php');
	function sendmail($whoborrow,$book){
 		$mail= new PHPMailer();							//建立新物件
		$mail->SMTPDebug = 0;                        
		$mail->IsSMTP();								//設定使用SMTP方式寄信
		$mail->SMTPAuth = true;							//設定SMTP需要驗證
		$mail->SMTPSecure = "ssl";						// Gmail的SMTP主機需要使用SSL連線
		$mail->Host = "smtp.gmail.com";					//Gamil的SMTP主機
		$mail->Port = 465;								//Gamil的SMTP主機的埠號(Gmail為465)。
		$mail->CharSet = "utf-8";						//郵件編碼
		$mail->Username = "jimmy0844@mail.fcu.edu.tw";		//Gamil帳號
		$mail->Password = "br890531";					//Gmail密碼
		$mail->From = "jimmy0844@mail.fcu.edu.tw";		//寄件者信箱
		$mail->FromName = "實驗室圖書館裡系統";			//寄件者姓名
		$mail->Subject ="提醒還書通知"; 				//郵件標題
		$mail->Body = "你借閱的書籍: ".$book."，有人要借閱請盡快歸還。"; //郵件內容
		$mail->IsHTML(false);							//郵件內容為html
		$mail->AddAddress("$whoborrow");					//收件者郵件及名稱
		if(!$mail->Send()){
			echo "Error: " . $mail->ErrorInfo;
		}else{
			echo "<div align = 'center'><h5><font color='#008800'><b>Send to ";
			echo $whoborrow;
			echo " Completed!</b></font></h5></div>";
		}
    }
	
	function sendmail_add($whoborrow,$book){
			
 		$mail= new PHPMailer();							//建立新物件
		$mail->SMTPDebug = 0;                        
		$mail->IsSMTP();								//設定使用SMTP方式寄信
		$mail->SMTPAuth = true;							//設定SMTP需要驗證
		$mail->SMTPSecure = "ssl";						// Gmail的SMTP主機需要使用SSL連線
		$mail->Host = "smtp.gmail.com";					//Gamil的SMTP主機
		$mail->Port = 465;								//Gamil的SMTP主機的埠號(Gmail為465)。
		$mail->CharSet = "utf-8";						//郵件編碼
		$mail->Username = "jimmy0844@mail.fcu.edu.tw";		//Gamil帳號
		$mail->Password = "br890531";					//Gmail密碼
		$mail->From = "jimmy0844@mail.fcu.edu.tw";		//寄件者信箱
		$mail->FromName = "實驗室圖書館裡系統";			//寄件者姓名
		$mail->Subject ="新書上架通知"; 				//郵件標題
		$mail->Body = "有新的圖書增加: ".$book."，有興趣的人歡迎來借閱。"; //郵件內容
		$mail->IsHTML(false);							//郵件內容為html
		$mail->AddAddress("$whoborrow");				//收件者郵件及名稱
		if(!$mail->Send()){
			echo "Error: " . $mail->ErrorInfo;
		}else{
			echo "<font color='#008800'><b>Send to ";
			echo $whoborrow;
			echo " completed.  </b></font>";
		}
    }
?>