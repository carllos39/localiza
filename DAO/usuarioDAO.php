<?php 
require_once __DIR__. "/../Model/usuario.php";   
require_once __DIR__."/../conexao.php";           
class usuarioDAO{
    private $bd;
    public function __construct()
    {
    $this->bd = Conexao ::getInstance();
    }

  public function create(Usuario $usuario){
   $sql="INSERT INTO usuario(nome,email,senha) VALUES(:nome,:email,:senha)";
   $stmt= $this->bd->prepare($sql);
   $stmt->execute([
    ':nome'=>$usuario->getNome(),
    ':email'=>$usuario->getEmail(),
    ':senha'=>$usuario->getSenha()
   ]);
    }
      public function update(Usuario $usuario){
   $sql="UPDATE usuario SET nome=:nome,email=:email,senha=:senha WHERE id=:id";
   $stmt= $this->bd->prepare($sql);
   $stmt->execute([
    ':id'=>$usuario->getId(),
    ':nome'=>$usuario->getNome(),
    ':email'=>$usuario->getEmail(),
    ':senha'=>$usuario->getSenha()
   ]);
    }
    public function excluir( $id){
   $sql="UPDATE usuario SET nome=:nome,email=:email,senha=:senha WHERE id=:id";
   $stmt= $this->bd->prepare($sql);
   $stmt->execute([
    ':id'=>$id
 
   ]);
    }
    public function getAll(){
        $sql="SELECT * FROM usuario ";
        $usuarios=[];
        $stmt =$this->bd->query($sql);
        while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        $usuarios[] =new Usuario(
            $row['id'],
            $row['nome'],
            $row['email'],
            $row['senha']
        );
    }
return $usuarios;
        }
        public function getById($id):?Usuario{
        $sql="SELECT * FROM usuario WHERE id=:id";
        $stmt =$this->bd->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $row= $stmt->fetch(PDO::FETCH_ASSOC);
        $usuarios ? new Usuario(
            $row['id'],
            $row['nome'],
            $row['email'],
            $row['senha']
        ):null;

        }
         public function getByEmail($email){
        $sql="SELECT * FROM usuario WHERE email=:email";
        $stmt =$this->bd->prepare($sql);
        $stmt->execute([':email'=>$email]);
        return $row= $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
          new Usuario(
            $row['id'],
            $row['nome'],
            $row['email'],
            $row['senha']
        );
        }else{
            return null;
        }
        }

        }

    
    

?>