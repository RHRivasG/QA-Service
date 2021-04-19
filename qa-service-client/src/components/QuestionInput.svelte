<script>
	import { user } from "../stores/auth.js";

	let message = "";
	let alert = "";

	function handleClick() {
		let questionInfo = {
			message: message,
		};
		fetch("http://192.168.1.7:8000/api/questions/create", {
			method: "post",
			headers: {
				Authorization: "Bearer " + $user.access_token,
				"Content-Type": "application/json",
			},
			body: JSON.stringify(questionInfo),
		}).then(async (res) => {
			alert = await res.json();
		});
		setTimeout(() => {
			alert = "";
		}, 4000);
		message = "";
	}
</script>

<style>
	.block {
		display: block;
		width: 100%;
	}
</style>

{#if alert != ''}
	<div
		data-aos="fade-down"
		data-aos-easing="linear"
		data-aos-duration="1500"
		data-aos-anchor="#body"
		class="notification is-primary is-light">
		{alert.message}
	</div>
{/if}

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
