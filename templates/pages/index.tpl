{extends file="include/master.tpl"}

{block name=body}
<div class="container">
	<h3>Welcome, [[FIRST NAME]]</h3>
	<div>
		<div class="sessions-table-container">
			<div class="sessions-table-header text-right">
				<button id="create-session" type="button" class="btn btn-success">
					<i class="fa fa-plus"></i> Create New
				</button>
			</div>
			<table class="table table-hover table-condensed">
				<thead>
					<tr>
						<th>Description</th>
						<th>Responses</th>
						<th>Created On</th>
						<th>Expires On</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					{foreach $sessions as $session}
					<tr class="{$session['tr_css_classs']}" title="#{$session['id']}">
						<td>{$session['description']}</td>
						<td>{count($session['responses'])} ({$session['happy_pc']}%)</td>
						<td>{$session['created_at']}</td>
						<td>{$session['expires_at']}</td>
						<td><a href="{$session['feedback_link']}" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-share-alt"></i></a></td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>
{/block}