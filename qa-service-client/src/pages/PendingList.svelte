<script>
	import QuestionCard from "../components/QuestionCard.svelte";
	import { user } from "../stores/auth.js";
	import { navigate } from "svelte-routing";
	import { onMount } from "svelte";

	onMount(() => {
		if ($user) {
			navigate("/");
		}
	});
	const questions = [
		{
			state: "pending",
			message: "What is Lorem Ipsum?",
			user: "BMary89",
			date: "11:09 PM - 12 Apr 2021",
			answer:
				"Lorem Ipsu is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
			dateAnswer: "11:05 PM - 13 Apr 2021",
		},
		{
			state: "pending",
			message: "What is Lorem Ipsum?",
			user: "BMary899",
			date: "11:09 PM - 12 Apr 2021",
			answer:
				"Lorem Ipsu is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
			dateAnswer: "11:09 PM - 12 Apr 2021",
		},
	];

	function handleSend(event) {
		console.log(event.detail.text + " sent.");
	}

	function handleDeny(event) {
		console.log(event.detail.text + " denied.");
	}
</script>

<style>
	.content-layout {
		padding-left: 10%;
		padding-right: 10%;
	}
</style>

<div class="content-layout">
	<div class="box has-text-left">
		<h3 class="title is-3 has-text-warning-dark ml-5">Pending</h3>

		{#each questions as question}
			<QuestionCard
				{...question}
				on:send={handleSend}
				on:deny={handleDeny} />
		{/each}
	</div>
</div>
