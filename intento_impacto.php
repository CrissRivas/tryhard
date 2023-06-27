<?php
	//100 no corresponde a un metodo valido
	//200 error en la base de datos

	$res = '';
	$err = '';
	
	//variables de conexion a la base
	$servername = "mageova.net";
	$database = "mageova_portales";
	$username = "mageova_mageova";
	$password = "C5z4p0p4n";

	//variables de peticion del servidor
	$host_campana = $_SERVER['HTTP_HOST'];
	$path = "";
	$identificador = $_SERVER['HTTP_USER_AGENT'];
	$direccion_ip = $_SERVER['REMOTE_ADDR'];
	$user_os        = getOS();
	$user_browser   = getBrowser();
	$dispositivo = $_POST['id'];
	
	//crea la conexion a la base
	$conn = mysqli_connect($servername, $username, $password, $database);
	
	if (!$conn) 
	{
		$err = "Error en la conexion: ".mysqli_connect_error();
	}
	else
	{		
		if( isset($_POST["intento"]) )
		{
			$folio = getFolio(); //genera un folio
			
			$query = "INSERT INTO Intentos (host_campana,path,fecha,identificador, folio, dispositivo_rt, direccion_ip, navegador, sistema) 
			VALUES ('".$host_campana."','".$path."' ,now(), '".$identificador."','".$folio."','".$dispositivo."','".$direccion_ip."','".$user_browser."','".$user_os."')";
			
			$sqlInsertar = $conn->query($query);
			
			$res = $folio;
		}
		elseif(isset($_POST["impacto"]))
		{
			$folio = $_POST["folio"];
			
			$query = "INSERT INTO Impactos (host_campana,path,fecha,identificador, folio, dispositivo_rt, direccion_ip, navegador, sistema) 
			VALUES ('".$host_campana."','".$path."' ,now(), '".$identificador."','".$folio."','".$dispositivo."','".$direccion_ip."','".$user_browser."','".$user_os."')";
			
			$sqlInsertar = $conn->query($query);
			$res = $query;
		}
		else
		{
			$err = "No corresponde a un método valido";
		}
	}

	$json = array(
		'res' => $res,
		'err' => $err
	);
	echo json_encode($json);


	function getFolio()
	{
		$folio = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', 
		mt_Rand(0, 65535), mt_Rand(0, 65535), mt_Rand(0, 65535), mt_Rand(16384, 20479), mt_Rand(32768, 49151), mt_Rand(0, 65535), mt_Rand(0, 65535), mt_Rand(0, 65535)).time();
		return $folio;
	}

	//identifica el sistema operativo
	function getOS() 
	{ 
		global 	$identificador;
		$os_platform  = "Unknown OS Platform";

		$os_array     = array(
				  '/windows nt 10/i'      =>  'Windows 10',
				  '/windows nt 6.3/i'     =>  'Windows 8.1',
				  '/windows nt 6.2/i'     =>  'Windows 8',
				  '/windows nt 6.1/i'     =>  'Windows 7',
				  '/windows nt 6.0/i'     =>  'Windows Vista',
				  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
				  '/windows nt 5.1/i'     =>  'Windows XP',
				  '/windows xp/i'         =>  'Windows XP',
				  '/windows nt 5.0/i'     =>  'Windows 2000',
				  '/windows me/i'         =>  'Windows ME',
				  '/win98/i'              =>  'Windows 98',
				  '/win95/i'              =>  'Windows 95',
				  '/win16/i'              =>  'Windows 3.11',
				  '/macintosh|mac os x/i' =>  'Mac OS X',
				  '/mac_powerpc/i'        =>  'Mac OS 9',
				  '/linux/i'              =>  'Linux',
				  '/ubuntu/i'             =>  'Ubuntu',
				  '/iphone/i'             =>  'iPhone',
				  '/ipod/i'               =>  'iPod',
				  '/ipad/i'               =>  'iPad',
				  '/android/i'            =>  'Android',
				  '/blackberry/i'         =>  'BlackBerry',
				  '/webos/i'              =>  'Mobile'
			);

		foreach ($os_array as $regex => $value)
			if (preg_match($regex, 	$identificador))
				$os_platform = $value;

		return $os_platform;
	}

	//identifica el navegador
	function getBrowser() 
	{
		global 	$identificador;

		$browser        = "Unknown Browser";
		$browser_array = array(
					'/msie/i'      => 'Internet Explorer',
					'/firefox/i'   => 'Firefox',
					'/safari/i'    => 'Safari',
					'/chrome/i'    => 'Chrome',
					'/edge/i'      => 'Edge',
					'/opera/i'     => 'Opera',
					'/netscape/i'  => 'Netscape',
					'/maxthon/i'   => 'Maxthon',
					'/konqueror/i' => 'Konqueror',
					'/mobile/i'    => 'Handheld Browser'
			 );

		foreach ($browser_array as $regex => $value)
			if (preg_match($regex, 	$identificador))
				$browser = $value;

		return $browser;
	}


?>