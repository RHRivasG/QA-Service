<script>
	import { user } from "../stores/auth.js";

	let message = "";

	function handleClick() {
		let questionInfo = {
			message: message,
		};
		fetch("http://localhost:8000/api/questions/create", {
			method: "post",
			headers: {
				Authorization: "Bearer " + $user.access_token,
				"Content-Type": "application/json",
			},
			body: JSON.stringify(questionInfo),
		}).then(async (res) => {
			console.log(await res.json());
		});
		message = "";
	}
</script>

<style>
	.block {
		display: block;
		width: 100%;
	}
</style>

<div class="box">
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
</div>
