@php 
$bugs = App\Bug::all();
@endphp

@foreach($bugs as $bug)
<table>
	<tr>
		<td></td>
	</tr>
</table>
@endforeach