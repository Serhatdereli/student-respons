{extends file="include/master.tpl"}

{block name=body}
<div class="container">
	<div class="col-sm-3">
		<h3>Welcome, [[FIRST NAME]]</h3>
		<ul>
			<li>dont remember</li>
			<li>stats table</li>
		</ul>
	</div>
	<div class="col-sm-9">
		<p>Venn diagram here</p>
		<div class="sessions-table-container">
			<div class="sessions-table-header text-right">
				<button id="create-session" type="button" class="btn btn-success">
					<i class="fa fa-plus"></i> Create New
				</button>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Created At</th>
						<th>Expires At</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1234</td>
						<td>urmum</td>
						<td>urdad</td>
						<td>triggered</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
{/block}