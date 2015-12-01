<h1>Liste pipe</h1>
<a href="?controler=pipe&action=add"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un nouveau pipe</a>
<!-- <a href="?controler=pipe&action=csvImport"> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Importé</a> -->
<!-- <a href="?controler=csv&action=pipeexport"> <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Exporté</a> -->
<br><br>
<table class="table table-bordered" style="background-color: white;">
<tr>
<th>id</th>
<th>nom</th>
<th>url cible</th>
<th>Paramétré</th>
<th>Suprimer</th>
  </tr>
  <?php
  foreach ($pipes as $pipe) {
  	echo '
  <tr>
  <td>'.$pipe->id().'</td>
    <td><a href="?controler=pipe&action=edit&id='.$pipe->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span>'.$pipe->name().'</a></td>
	<td>'.$pipe->baseurl().'</td>
	<td><a href="?controler=pipeoption&action=list&id='.$pipe->id().'"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Paramétré</a></td>
	<td><a href="?controler=pipe&action=del&id='.$pipe->id().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Suprimer</a></td>
    		</tr>
    		';
}
?>
</table> 
