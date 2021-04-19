<script>
	import QuestionCard from "../components/QuestionCard.svelte";
	import { user } from "../stores/auth.js";
	import QuestionInput from "../components/QuestionInput.svelte";
	import { onMount } from "svelte";

	let questions = [];

	onMount(() => {
		fetch("http://192.168.1.7:8000/api/questions/accepted").then(
			async (res) => {
				questions = await res.json();
			}
		);
	});
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
