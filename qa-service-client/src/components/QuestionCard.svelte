<script>
	import { createEventDispatcher } from "svelte";
	export let message;
	export let user;
	export let date;
	export let answer;
	export let dateAnswer;
	export let state;

	const dispatch = createEventDispatcher();
	let answerPending = "";

	let stateColorText = "";
	let stateColorBorder = "";
	switch (state) {
		case "accepted":
			stateColorText = "has-text-info";
			stateColorBorder = "border-info";
			break;
		case "pending":
			stateColorText = "has-text-warning-dark";
			stateColorBorder = "border-warning";
			break;
		case "denied":
			stateColorText = "has-text-danger";
			stateColorBorder = "border-danger";
			break;
	}

	function sendQuestion() {
		dispatch("send", { text: answerPending });
	}

	function denyQuestion() {
		dispatch("deny", {text: message});
	}
</script>

<style>
	.card {
		border-style: solid;
		border-width: 1px;
	}
	.border-info {
		border-color: #3298dc;
	}
	.border-warning {
		border-color: #946c00;
	}
	.border-danger {
		border-color: #f14668;
	}
</style>

<div class="card m-5 {stateColorBorder} ">
	<div class="card-content">
		<div class="content">
			<p class="title is-4 has-text-grey">{message}</p>
			<p class="subtitle is-6 has-text-primary">{user} ({date})</p>
			{#if state == 'accepted'}
				{answer}
				<br />
				<p class="has-text-right">
					<time
						datetime="2021-4-12"
						class="has-text-right {stateColorText}">
						{dateAnswer}
					</time>
				</p>
			{:else if state == 'pending'}
				<textarea
					bind:value={answerPending}
					class="textarea"
					placeholder="e.g. Hello world" />
				<div class="is-flex is-justify-content-flex-end">
					<div class="field is-grouped m-3">
						<div class="control">
							<button
								on:click={sendQuestion}
								class="button is-success">Send</button>
						</div>
						<div class="control">
							<button
								on:click={denyQuestion}
								class="button is-link is-danger">Deny</button>
						</div>
					</div>
				</div>
			{/if}
		</div>
	</div>
</div>
