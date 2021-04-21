<script>
	import { user, setStoreUser } from "../stores/auth.js";
	import { navigate } from "svelte-routing";
	import { onMount } from "svelte";
	import { registerApi } from "../api/auth-api";

	onMount(() => {
		if ($user) {
			navigate("/");
		}
	});

	let name = "";
	let password = "";

	function register() {
		setTimeout(async () => {
			let userRegistered = {
				username: name,
				password: password,
			};
			let response = await registerApi(userRegistered);
			if ((await response.message) == "OK") {
				user.loginUser(await response);
				setStoreUser(await response);
				navigate("/");
			} else {
				alert = await response.message;
				setTimeout(() => {
					alert = "";
				}, 4000);
			}
		}, 1000);
	}
</script>

<style>
	.content-layout {
		padding-left: 25%;
		padding-right: 25%;
	}
	.block {
		display: block;
		width: 100%;
	}
</style>

<div class="content-layout">
	<div class="box">
		<h3 class="title is-3 has-text-info">Register</h3>
		<div class="field has-text-left">
			<label for="username" class="label has-text-grey">Username</label>
			<div class="control has-icons-left">
				<input
					bind:value={name}
					class="input"
					type="text" />
				<span class="icon is-small is-left">
					<i class="fas fa-user" />
				</span>
			</div>
		</div>
		<div class="field has-text-left">
			<label for="password" class="label has-text-grey">Password</label>
			<div class="control has-icons-left">
				<input
					bind:value={password}
					class="input"
					type="password" />
				<span class="icon is-small is-left">
					<i class="fas fa-key" />
				</span>
			</div>
		</div>
		<div class="field">
			<div class="control">
				<button on:click={register} class="button is-link block">Sign up</button>
			</div>
		</div>
	</div>
</div>
