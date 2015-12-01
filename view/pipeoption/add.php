<div class="jumbotron">
	<h1>ajouter une option</h1>
	<br>
	<form action="?controler=pipe&action=add" method="POST" class="form-horizontal">
		<div class="form-group">
			<label for="question" class="col-sm-2 control-label">nom du pipe</label>
			<div class="col-sm-10">
				<input type="text"class="form-control"  id="name" name="name">
			</div>
		</div>
		<br>
		<div class="form-group">
			<label for="question" class="col-sm-2 control-label">url cible</label>
			<div class="col-sm-10">
				<input type="text"class="form-control" id="baseurl" name="baseurl">
			</div>
		</div>
		<br>
		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-default" value="Ajouter">
			</div>
		</div>
	</form>
</div>