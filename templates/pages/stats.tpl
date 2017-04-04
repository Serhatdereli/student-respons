{extends file="include/master.tpl"}

{block name=body}
<div class="container">
	<h2 class="text-right">Session Stats <i class="fa fa-line-chart"></i></h2>
	<h4>Session Description</h4>
	<div class="well">
		<p>{$session_desc}</p>
	</div>
	<div id="sentiment-pie-chart"></div>
	{literal}
	<script type="text/javascript">
		$(document).ready(function ()
		{
			Highcharts.chart('sentiment-pie-chart', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Sentiment Analysis for Session'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						},
						showInLegend: true
					}
				},
				series: [{
					name: 'Sentiment',
					colorByPoint: true,
					data: [
					{
						name: 'Positive',
						y: {/literal}{$positive_num}{literal}
					},
					{
						name: 'Negative',
						y: {/literal}{$negative_num}{literal}
					},
					{
						name: 'Neutral',
						y: {/literal}{$neutral_num}{literal}
					}
					]
				}],
				credits: {
					enabled: false
				}
			});
		});
	</script>
	{/literal}

	<hr />
	<h3>Responses</h3>
	<table class="table table-striped table-condensed table-hover">
		<thead>
			<tr>
				<th>Created At</th>
				<th>Feedback</th>
				<th>Sentiment</th>
			</tr>
		</thead>
		<tbody>
			{foreach $responses as $response}
			<tr>
				<td>{$response['created_at']}</td>
				<td>{$response['feedback']}</td>
				<td>{$response['sentiment']}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
{/block}

{block name=js}
<script src="https://code.highcharts.com/highcharts.src.js" type="text/javascript"></script>
{/block}