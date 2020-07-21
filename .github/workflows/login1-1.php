<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		session_start();
		$user=$_POST["user"];
		$pass=sha1($_POST["pass"]);
		$manager = new MongoDB\Driver\Manager("mongodb://admin:adm1n03srv@cluster0-shard-00-00.fdt3e.mongodb.net:27017,cluster0-shard-00-01.fdt3e.mongodb.net:27017,cluster0-shard-00-02.fdt3e.mongodb.net:27017/DocumentDb?ssl=true&replicaSet=atlas-edcpx1-shard-0&authSource=admin&retryWrites=true&w=majority");     
		$filter2      = ['login' => $user,'password'=>$pass];
		$options2 = [''];
		$find = new \MongoDB\Driver\Query($filter2);
		$rows   = $manager->executeQuery('DocumentDb.users', $find); 
		$rows_num   = $manager->executeQuery('DocumentDb.users', $find); 
		if (!empty($rows_num->toArray())) {
			foreach ($rows as $row) {
				if($rows){
					$_SESSION["login"]["id"]=$row->iduser;
					$_SESSION["login"]["login"]=$row->login;
					$_SESSION["login"]["pass"]=$row->password;
					$_SESSION["login"]["name"]=$row->name;
					$_SESSION["login"]["banco"]=$row->banco;
					$_SESSION["login"]["notes"]=$row->notes;
					$_SESSION["login"]["is_comp"]=$row->is_comp;
					$_SESSION["login"]["is_admin"]=$row->is_admin;
					$_SESSION["login"]["kardex"]=$row->kardex;
					$_SESSION["login"]["bbva"]=$row->bbva;
					$_SESSION["login"]["noproto"]=$row->noproto;
					$_SESSION["login"]["alegal"]=$row->alegal;
					$_SESSION["login"]["scotb"]=$row->scotb;
					$_SESSION["login"]["leasing"]=$row->leasing;
					$_SESSION["login"]["session_start"]=date("Y-m-d H:i:s");
					
					header("location: dashboard.php");

					}else{
							header("location:index.php");
						 }
			}
	 	}else{
		header("location:index.php");
	 }	 
    }else{
		header("location:index.php"); 
}

?>



