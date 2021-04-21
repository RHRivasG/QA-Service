<script>
	import { user } from "../stores/auth.js";
	import { sendQuestion } from "../api/question-api";

	let message = "";
	let alert = "";

	async function handleClick() {
		let questionInfo = {
			message: message,
		};

		alert = await sendQuestion(questionInfo, $user);
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
				class="textarea" />
		</p>
	</div>
	<button on:click={handleClick} class="button is-success block">
		Send
	</button>
</div>
