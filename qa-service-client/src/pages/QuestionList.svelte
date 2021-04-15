<script>
	import { user } from "../stores/auth.js";
	import QuestionCard from "../components/QuestionCard.svelte";
	import QuestionInput from "../components/QuestionInput.svelte";
	const questions = [
		{
			state: "accepted",
			message: "What is Lorem Ipsum?",
			user: "BMary89",
			date: "11:09 PM - 12 Apr 2021",
			answer:
				"Lorem Ipsu is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
			dateAnswer: "11:05 PM - 13 Apr 2021",
		},
		{
			state: "accepted",
			message: "Where does it come from?",
			user: "BMary899",
			date: "11:09 PM - 12 Apr 2021",
			answer:
				"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.",
			dateAnswer: "11:05 PM - 15 Apr 2021",
		},
	];
	$: console.log($user);
</script>

<style>
	.content-layout {
		padding-left: 10%;
		padding-right: 10%;
	}
</style>

<div class="content-layout">
	{#if $user}
		<QuestionInput />
	{/if}

	<div class="box has-text-left">
		<h3 class="title is-3 has-text-info ml-5">Questions</h3>
		{#each questions as question}
			<QuestionCard {...question} />
		{/each}
	</div>
</div>
