<script>
	import { user, setStoreUser } from "../stores/auth.js";
	import { navigate } from "svelte-routing";
	import { onMount } from "svelte";

	onMount(() => {
		if ($user) {
			navigate("/");
		}
	});

	let name = "";
	let password = "";

	function login() {
		setTimeout(() => {
			let userLogged = {
				username: name,
				token: 1234,
			};
			user.loginUser(userLogged);
			setStoreUser(userLogged);
			navigate("/");
		}, 1000);
	}
</script>

<style>
	.content-layout {
		padding-left: 25%;
		padding-right: 25%;
	}
</style>

<div class="content-layout">
	<div class="box">
		<h3 class="title is-3 has-text-info">Login</h3>
		<div class="field has-text-left">
			<label for="username" class="label has-text-grey">Username</label>
			<div class="control has-icons-left">
				<input
					bind:value={name}
					class="input"
					type="text"
					placeholder="Text input" />
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
					type="password"
					placeholder="Text input" />
				<span class="icon is-small is-left">
					<i class="fas fa-key" />
				</span>
			</div>
		</div>
		<div class="field">
			<div class="control">
				<button on:click={login} class="button is-link">Sign in</button>
			</div>
		</div>
	</div>
</div>
