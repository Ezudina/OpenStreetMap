<?php


class Connection
{
	private $basename;
	private $username;
	private $password;
	private $servername;
	private $connection;
	
  
	public function Connection($servername, $username, $basename, $password="")
	{
		$this->servername = $servername;
	    $this->username = $username;
		$this->basename = $basename;
		$this->password = $password;
	}
	
	public function connect()
	{
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->basename);
		if($conn->connect_error) die($conn->connect_error);
		else $this->connection = $conn;

	}
	
	public function execute_query($query){
		$result = $this->connection->query($query);
		if(!$result) die($this->connection->error);
		return $result;
	}
	
}

?>