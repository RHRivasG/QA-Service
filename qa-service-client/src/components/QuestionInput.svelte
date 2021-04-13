<script>
	let message = "";

	function handleClick() {
		console.log(message);
		message = "";
	}
</script>

<style>
	.block {
		display: block;
		width: 100%;
	}
</style>

<!--

<div class="notification is-primary is-light">Question sent!</div>

<div class="notification is-danger is-light">Send error.</div>
-->

<form class="box">
	<label
		for="question-input"
		class="label is-size-4 has-text-grey has-text-left">
		Do you have a question?</label>
	<div class="field">
		<p class="control is-expanded">
			<textarea
				bind:value={message}
				class="textarea"
				placeholder="e.g. Hello world" />
		</p>
	</div>
	<button on:click={handleClick} class="button is-success block">
		Send
	</button>
</form>
