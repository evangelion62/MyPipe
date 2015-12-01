<h1>Liste paramétre</h1>
<a href="?controler=pipeoption&action=add"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un nouveau paramétre</a>
<!-- <a href="?controler=pipeoption&action=csvImport"> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Importé</a> -->
<!-- <a href="?controler=csv&action=pipeoptionexport"> <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Exporté</a> -->
<br><br>
<table class="table table-bordered" style="background-color: white;">
<tr>
<th>id</th>
<th>type</th>
<th>url cible</th>
<th>Suprimer</th>
  </tr>
  <?php
  foreach ($pipeoptions as $pipeoption) {
  	echo '
  <tr>
  <td>'.$pipeoption->id().'</td>
    <td><a href="?controler=pipeoption&action=edit&id='.$pipeoption->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span>'.$pipeoption->name().'</a></td>
	<td>'.$pipeoption->baseurl().'</td>
    <td><a href="?controler=pipeoption&action=del&id='.$pipeoption->id().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Suprimer</a></td>
    		</tr>
    		';
}
?>
</table> 
