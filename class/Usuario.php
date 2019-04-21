
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
			$this->setData($result[0]);
		}
	}

		public function setData($data){
			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
		}

public function update($login,$pass){
			$sql = new Sql();
			
			$this->setDeslogin($login);
			$this->setDessenha($pass);

			$sql->query("UPDATE tb_usuario SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID",array(
				':LOGIN'=>$this->getDeslogin(),
				':PASS'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));

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

		public static function insert($login,$senha){
			$sql = new Sql();
			$sql->query("INSERT INTO tb_usuario(deslogin,dessenha)VALUES(:LOGIN,:PASS)", array(
				':LOGIN'=>$login,
				':PASS'=>$senha
			));

			return $sql->query("SELECT * FROM tb_usuario WHERE idusuario =  LAST_INSERT_ID()");
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


