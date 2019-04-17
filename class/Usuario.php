
 <?php 


 class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;


	public function getIdusuario(){
		return $this->idusuario;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}
	
	

	public function loadById($id){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuario WHERE idusuario = :ID",array(
			":ID"=>$id 
		));

		if(isset($result[0])){
			$row = $result[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}



	}
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuario ORDER BY idusuario");

	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			':SEARCH'=>"%".$login."%"

		));}

		public static function login($login,$senha){
			$sql = new Sql();

			$result = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
				':LOGIN'=>$login,
				':SENHA'=>$senha
			));

			if(count($result) == 0){
				echo "Nem um usuario encontrado<br>";
			}else{
				return $result;
			}
		}

	


	
	
	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}


}
 


?>


