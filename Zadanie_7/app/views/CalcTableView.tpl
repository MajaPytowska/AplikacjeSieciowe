{extends file="main.tpl"}
{block name=content} 
<header class="major">
	<h2>Historia obliczeń</h2>
</header>
	<div class="row" style="justify-content: center; min-width: 0;">
	<div class="col-12" style="overflow-x: auto;">
		<table>
			<thead>
				<tr>
					<th>Data obliczenia</th>
					<th>Kwota kredytu</th>
					<th>Ilość lat</th>
					<th>Oprocentowanie</th>
					<th>Rata miesięczna</th>
				</tr>
			</thead>
			<tbody>
				{foreach $form as $f}
				<tr>
					<td>{$f.date}</td>
					<td>{$f.loan} zł</td>
					<td>{$f.years}</td>
					<td>{$f.procent}%</td>
					<td>{$f.result} zł</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	</div>
{/block} 