<ul>
	<li class=""><a href="/posts">Post Products</a></li>	
	<li class=""><a href="/setting/accounts">Setting Accounts</a></li>	
</ul>

<h2>Setting Accounts</h2>

@foreach($columns as $column)
	@if(strrpos($column, 'tk_') !== false)
		<?php $newColumn = str_replace('tk_', '', $column); ?>

		<label for="facebook">{{ ucwords($newColumn) }}</label> :

		@if(count($tokens) > 0 && $tokens[0]->$column)
			 Connected (<a href="/setting/accounts/{{ $newColumn }}_disconnect">disconnect</a>) <br />
		@else
			<a href="/setting/accounts/{{ $newColumn }}_connect">
				Connect with {{ ucwords($newColumn) }}
			</a> <br />
		@endif

	@endif
@endforeach