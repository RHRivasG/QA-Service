<script>
	import { createEventDispatcher } from "svelte";
	export let id = "";
	export let message = "";
	export let username = "";
	export let question_date = "";
	export let answer = "";
	export let answer_date = "";
	export let status = "";

	const dispatch = createEventDispatcher();
	let answerPending = "";

	let stateColorText = "";
	let stateColorBorder = "";
	switch (status) {
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
		dispatch("send", {
			text: answerPending,
			id: id,
			date: question_date,
		});
	}

	function denyQuestion() {
		dispatch("deny", {
			id: id,
			date: question_date,
		});
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

<div
	data-aos="fade-right"
	data-aos-offset="200"
	class="card m-5 {stateColorBorder} ">
	<div class="card-content">
		<div class="content">
			<p class="title is-4 has-text-grey">{message}</p>
			<p class="subtitle is-6 has-text-primary">
				{username}
				({question_date})
			</p>
			{#if status == 'accepted'}
				{answer}
				<br />
				<p class="has-text-right">
					<time
						datetime="2021-4-12"
						class="has-text-right {stateColorText}">
						{answer_date}
					</time>
				</p>
			{:else if status == 'pending'}
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
			{:else}
				<p class="has-text-right">
					<time
						datetime="2021-4-12"
						class="has-text-right {stateColorText}">
						{answer_date}
					</time>
				</p>
			{/if}
		</div>
	</div>
</div>
