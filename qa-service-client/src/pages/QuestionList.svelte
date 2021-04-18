<script>
	import QuestionCard from "../components/QuestionCard.svelte";
	import { user } from "../stores/auth.js";
	import QuestionInput from "../components/QuestionInput.svelte";
	import Echo from "laravel-echo";

	const questions = [
		{
			status: "accepted",
			message: "What is Lorem Ipsum?",
			username: "BMary89",
			question_date: "11:09 PM - 12 Apr 2021",
			answer:
				"Lorem Ipsu is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
			answer_date: "11:05 PM - 13 Apr 2021",
		},
	];

	let quiz;
	function websockets() {
		const echo = new Echo({
			broadcaster: "pusher",
			cluster: "mt1",
			key: "ASD1234FG",
			wsHost: "localhost",
			wsPort: 6001,
			forceTLS: false,
			disableStats: true,
			enabledTransports: ["ws"],
		});
		echo.channel("channel-accepted").listen("AcceptedEvent", (resp) => {
			quiz = resp;
			console.log(resp);
		});
	}

	websockets();
</script>

<style>
	.content-layout {
		padding-left: 10%;
		padding-right: 10%;
	}
</style>

<div class="content-layout">
	{#if $user && $user.roles.includes('participant')}
		<QuestionInput />
	{/if}
	<div class="box has-text-left">
		<h3 class="title is-3 has-text-info ml-5">Questions</h3>
		{#each questions as question}
			<QuestionCard {...question} />
		{/each}
	</div>
</div>
