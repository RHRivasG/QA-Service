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
		fetch("http://192.168.1.7:8000/api/questions/pending", {
			method: "get",
			headers: {
				Authorization: "Bearer " + $user.access_token,
			},
		}).then(async (res) => {
			questions = await res.json();
		});
	});

	function handleSend(event) {
		let questionAnswer = {
			answer: event.detail.text,
			question_id: event.detail.id,
			question_date: event.detail.date,
		};
		fetch("http://192.168.1.7:8000/api/questions/answer", {
			method: "post",
			headers: {
				Authorization: "Bearer " + $user.access_token,
				"Content-Type": "application/json",
			},
			body: JSON.stringify(questionAnswer),
		}).then(async (res) => {
			console.log(await res.json());
		});

		console.log(event.detail.text + " sent.");
	}

	function handleDeny(event) {
		let questionDenied = {
			question_id: event.detail.id,
			question_date: event.detail.date,
		};
		fetch("http://192.168.1.7:8000/api/questions/deny", {
			method: "post",
			headers: {
				Authorization: "Bearer " + $user.access_token,
				"Content-Type": "application/json",
			},
			body: JSON.stringify(questionDenied),
		}).then(async (res) => {
			console.log(await res.json());
		});

		console.log(event.detail.id + " denied.");
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
