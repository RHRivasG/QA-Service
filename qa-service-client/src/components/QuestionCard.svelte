<script>
	export let message;
	export let user;
	export let date;
	export let answer;
	export let dateAnswer;
</script>

<style>
	.card {
		border-style: solid;
		border-color: #3298dc;
		border-width: 1px;
	}
</style>

<div class="card m-5">
	<div class="card-content">
		<div class="content">
			<p class="title is-4 has-text-grey">{message}</p>
			<p class="subtitle is-6 has-text-primary">{user} ({date})</p>
			{answer}
			<br />
			<p class="has-text-right">
				<time datetime="2021-4-12" class="has-text-right has-text-info">
					{dateAnswer}
				</time>
			</p>
		</div>
	</div>
</div>
