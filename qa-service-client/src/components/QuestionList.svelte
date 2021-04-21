<script>
	import { user } from "../stores/auth.js";
	import { navigate } from "svelte-routing";
	import { onMount } from "svelte";
	import QuestionInput from "./QuestionInput.svelte";
	import QuestionCard from "./QuestionCard.svelte";
	import { loadList, sendAnswer, denyQuestion } from "../api/question-api";

	export let typelist = "accepted";

	onMount(() => {
		if (!$user || !$user.roles.includes("moderator")) {
			if (typelist != "accepted") {
				navigate("/");
			}
		}
	});

	let title = typelist.charAt(0).toUpperCase() + typelist.slice(1);
	let promise = loadList(typelist, $user);

	let stateColorText = "";
	switch (typelist) {
		case "accepted":
			stateColorText = "has-text-info";
			break;
		case "pending":
			stateColorText = "has-text-warning-dark";
			break;
		case "denied":
			stateColorText = "has-text-danger";
			break;
	}

	function handleSend(event) {
		let questionAnswer = {
			answer: event.detail.text,
			question_id: event.detail.id,
			question_date: event.detail.date,
		};
		sendAnswer(questionAnswer, $user);
		promise = loadList("pending", $user);
	}

	function handleDeny(event) {
		let questionDenied = {
			question_id: event.detail.id,
			question_date: event.detail.date,
		};
		denyQuestion(questionDenied, $user);
		promise = loadList("pending", $user);
	}
</script>

<style>
	.content-layout {
		padding-left: 10%;
		padding-right: 10%;
	}
	#question-container {
		min-height: 200px !important;
	}
</style>

<div class="content-layout">
	{#if $user && $user.roles.includes('participant')}
		<QuestionInput />
	{/if}

	<div
		data-aos="fade-right"
		data-aos-offset="400"
		data-aos-easing="ease-in-sine"
		data-aos-anchor="#body"
		id="question-container"
		class="box has-text-left">
		<h3 class="title is-3 {stateColorText} ml-5">{title}</h3>

		{#await promise}
			<progress class="progress is-primary" max="100">30%</progress>
		{:then questions}
			{#each questions as question, i}
				<QuestionCard
					{...question}
					number={i}
					last={questions.length == i + 1}
					on:send={handleSend}
					on:deny={handleDeny} />
			{/each}
		{:catch error}
			<p style="color: red">{error.message}</p>
		{/await}
	</div>
</div>
