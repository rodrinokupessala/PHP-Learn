<?php
function redirect ($url=null){
  echo "
<script>window.location='$url'
</script>
 ";
  
}
/* Configuração: drive, host, dbname e charset*/

 $sdn="mysql:host=0.0.0.0;dbname=Task;charset=utf8";
 /* user and password*/
 $username="root";
 $password="pw";
  /* Connection 
  */
  $conn=new PDO(
    $sdn,
    $username,
    $password,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
    );
    if($conn):
      //echo "Conexão estabelecida!";
      $taskSQL="SELECT*FROM tasks;";
      $stm=$conn->query($taskSQL);
     /// $exec=$prepare->execute();
     $tasks=$stm->fetchAll();
     
     if(isset($_POST['insert'])):
       var_dump($_POST);
       $data=[
        'task'=>htmlspecialchars($_POST["task"]),
        'description'=>htmlspecialchars($_POST["description"]),
        'status'=>htmlspecialchars($_POST["status"]),
         'date_ini'=>htmlspecialchars($_POST["date_ini"]),
         'date_end'=>htmlspecialchars($_POST["date_end"])
         ];
       $prepInsert=$conn->prepare("INSERT INTO tasks (task,description,status,date_ini,date_end) values(:task,:description,:status,:date_ini,:date_end)");
       $prepInsert->execute($data);
       if($conn->lastInsertId()>0){
         //header('Location:index.php');
         redirect('index.php');
       }
       else{
         echo "Falha na inserção";
       }
       endif;
     
      endif;
     // var_dump($tasks);
     //var_dump($_POST);
      ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
        body{
          margin:0;
          font-size:15px;
        }
        .container{
          margin:0 auto;
          width:calc(700px -300px);}
        .container table ,th,td{
          border:solid 1px #3333;
        }
        .container th{
          background:#069;
        }
        .container form input,select {
          width: 1000px;
        }
        input,select:focus{
          border:solid 1px #069;
        }
.container table{
  width: calc(700px - 100px);
  
}
table th{
  color: #fff;
}
ul li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
tr td:hover {
  background: red;
  
}

/* When clicked on, add a background color and strike out text */
tr td.checked {
  background: #0854;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
tr td.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}
.container .title{
  background: #069;
  text-align: center;
  color: #fff;
  
  
  font-size: 14px;
  width: calc(700px - 100px);
  
}.container .c_bottons{
  margin: 0;
  padding: 3px;
}#btn_add{
  background: green;
  color: #fff;
}
#btn_rem{
  background: red;
  color: #fff;
}
      </style>
      <?php
      $botaoNome="insert";
      $botaoEtiqueta="Salvar";
      ?>
      <div class="container">
        <div class="title">
        <h1>Sistema de Gestão de Tarefas</h1>
        </div>
        <div class="c_bottons">
          <button id="btn_add">+</button>
          <button style="display:none;" id="btn_rem">X</button>
        </div>
        <form action="index.php" id="frm" method="post" style="display:none;">
          <input name="task" id="task" placeholder="Tarefa">
          <input name="description" id="description" placeholder="Descrição">
          <select name="status" id="status">
            <option value="Feito">Feito</option>
            <option value="Não feito">Não feito</option></option>
          </select> 
          <input name="date_ini" id="date_ini" type="date" placeholder="Data de início">
          <input name="date_end" id="date_end" type="date" placeholder="Data final">
          <button name="<?php echo $botaoNome;?>"><?php echo $botaoEtiqueta?></button></form>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tarefa</th>
              <th>Estado</th>
              <th>Data inicial</th>
              <th>Data final</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach ($tasks as $task):
      // var_dump($task);
       
            ?>
            <tr>
             
              <td><?php echo htmlentities($task["id"]) ?></td>
              <td><?php echo htmlentities($task["task"]) ?></td>
              <td><?php echo htmlentities($task["status"]) ?></td>
              <td><?php echo htmlentities($task["date_ini"]) ?></td>
              <td><?php echo htmlentities($task["date_end"]) ?></td>
              <td><?php echo htmlentities($task["date"]) ?></td>
            </tr<?php endforeach;?>
          </tbody>
        </table>
      </div>
<script>
var list = document.querySelector('tr');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'td') {
    ev.target.classList.toggle('checked');
  }
}, false);
var btn_add=document.getElementById('btn_add')
var btn_rem=document.getElementById('btn_rem')
btn_add.onclick=function (){
  var frm=document.getElementById("frm")
  frm.style="display:block"
  btn_rem.style="display:block"
  btn_add.style="display:none"
}
btn_rem.onclick=function(){
  frm.style="display:none"
  btn_rem.style="display:none"
  btn_add.style="display:block"
}

</script>
