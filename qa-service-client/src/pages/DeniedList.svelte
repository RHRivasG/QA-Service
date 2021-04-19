<script>
	import QuestionCard from "../components/QuestionCard.svelte";
	import { user } from "../stores/auth.js";
	import { navigate } from "svelte-routing";
	import { onMount } from "svelte";

	let questions = [];
	onMount(() => {
		if (!$user || !$user.roles.includes("moderator")) {
			navigate("/");
		}
		fetch("http://192.168.1.7:8000/api/questions/denied", {
			method: "get",
			headers: {
				Authorization: "Bearer " + $user.access_token,
			},
		}).then(async (res) => {
			questions = await res.json();
		});
	});
</script>

<style>
	.content-layout {
		padding-left: 10%;
		padding-right: 10%;
	}
</style>

<div class="content-layout">
	<div class="box has-text-left">
		<h3 class="title is-3 has-text-danger ml-5">Denied</h3>
		{#each questions as question}
			<QuestionCard {...question} />
		{/each}
	</div>
</div>
