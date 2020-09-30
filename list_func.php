<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Pesquisa Usuário</title>
       

</head> 

<body>

<?php	
include('dbc.php');
include('header.php');

?>

<div class="container">

        <div class="configdiv" id="resplist">
		
		

	<div class='table-responsive'>
	<TABLE align="center"  class='table table-striped table-sm' width="50%" height="50%" style="text-align: left; vertical-align: center">   
    <TD colspan="4" height="90" class="scBlock" style="text-align: left; vertical-align: center">
     <TABLE border="0" cellpadding="0" cellspacing="0" width="100%" height="70%">
      <TR>
       <tr>
			<th class='scFormLabelOdd'> Nome </th>
			<th class='scFormLabelOdd'> Editar Dados </th>
		</tr>
      </TR>
	 <legend>Lista de Funcionários</legend>
	 <?php

		$query = "select * from cad_membro";

 		$result = mysqli_query($conn, $query);
      
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
            
			$id=$row["id"];        
			$nome = $row["nome"];
						
			echo "<tr>";
				  
			echo utf8_encode ( "<td>" . $nome . "</td>");
			echo "<td> 
					<input type='image' src='img/b_edit.png'  id='b_edit' onClick='jsEdit($id)' title='Editar Dados'>
				  </td>";
			}
		}
echo " </table>";
?>
	</TABLE>
	</div>
<button type="submit" class="btn btn-primary" onclick = "jsNovo()"> Incluir </button>
</div>
</div>
</div>

</body>
</html>