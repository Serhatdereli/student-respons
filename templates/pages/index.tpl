{extends file="include/master.tpl"}

{block name=body}
<div class="container">
	<h3>Dashboard</h3>
	<div>
		<div class="sessions-table-container">
			<div class="sessions-table-header text-right">
				<button id="create-session" type="button" class="btn btn-success">
					<i class="fa fa-plus"></i> Create New
				</button>
			</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Description</th>
						<th>Feedback</th>
						<th>Responses</th>
						<th>Created On</th>
						<th>Expires On</th>
						<th></th>
						<th>Stats</th>
					</tr>
				</thead>
				<tbody>
					{foreach $sessions as $session}
					<tr class="{$session['tr_css_classs']}">
						<td title="#{$session['id']}">{$session['description']}</td>
						<td title="{$session['happy_pc']}%">
							<div class="sentiment-bar" data-happypc="{$session['happy_pc']}">
								<i class="fa fa-frown-o"></i>
								<div class="sentiment-bar-progress">
									<span class="sentiment-bar-dot"></span>
								</div>
								<i class="fa fa-smile-o"></i>
							</div>
						</td>
						<td>{count($session['responses'])}</td>
						<td>{$session['created_at']}</td>
						<td>{$session['expires_at']}</td>
						<td><a href="{$session['feedback_link']}" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-share-alt"></i></a></td>
						<td><a href="/stats/{$session['id']}" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-line-chart"></i></a></td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>
{/block}