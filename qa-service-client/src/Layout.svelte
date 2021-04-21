<script>
	import { Link, navigate } from "svelte-routing";
	import { user } from "./stores/auth.js";

	let selected = ["", "", ""];
	function linkClick(index) {
		selected = ["", "", ""];
		selected[index] = "is-active";
	}
	function logout() {
		fetch("http://192.168.1.7:8000/api/logout", {
			method: "post",
			headers: {
				Authorization: "Bearer " + $user.access_token,
			},
		}).then(async (res) => {
			user.logoutUser();
			localStorage.clear();
			if (selected.indexOf("is-active") == 1) {
				navigate("/denied");
			} else {
				navigate("/pending");
			}
			console.log(await res.json());
		});
	}
</script>

<style>
	.navbar-burger {
		margin-right: 0;
	}

	div.navbar-end {
		margin-right: 0;
	}

	div.navbar-start {
		margin-left: 0;
	}
	a:first-child:focus {
		background-color: inherit !important;
	}
</style>

<section class="hero is-info is-fullwidth is-fullheight">
	<div class="hero-head">
		<nav
			class="navbar is-spaced"
			role="navigation"
			aria-label="main navigation">
			<div class="navbar-brand">
				<a href="/" class="title">Q&A Service</a>

				<a
					href="/"
					role="button"
					class="navbar-burger"
					aria-label="menu"
					aria-expanded="false"
					data-target="navbarBasicExample">
					<span aria-hidden="true"> Accepted </span>
					<span aria-hidden="true" />
					<span aria-hidden="true" />
				</a>
			</div>

			{#if $user && $user.roles.includes('moderator')}
				<div id="navbarBasicExample" class="navbar-menu mb-4">
					<div class="navbar-start">
						<Link
							class="navbar-item {selected[0]}"
							to="/"
							on:click={() => linkClick(0)}>
							Accepted
						</Link>
						<Link
							class="navbar-item {selected[1]}"
							to="/pending"
							on:click={() => linkClick(1)}>
							Pending
						</Link>
						<Link
							class="navbar-item {selected[2]}"
							to="/denied"
							on:click={() => linkClick(2)}>
							Denied
						</Link>
					</div>
				</div>
			{/if}

			{#if $user}
				<div class="navbar-end">
					<div
						class="navbar-item has-dropdown is-hoverable has-background-info">
						<button href="/" class=" button is-white has-text-info">
							<span> {$user.username} </span>
							<span class="icon is-small">
								<i class="fas fa-chevron-down" />
							</span>
						</button>

						<div class="navbar-dropdown is-right">
							<button
								on:click={logout}
								class="navbar-item button has-text-info is-white is-fullwidth">
								Logout
							</button>
						</div>
					</div>
				</div>
			{:else}
				<div class="navbar-end">
					<div class="buttons">
						<Link
							to="/login"
							class="button has-text-info is-white ">
							Login
						</Link>
						<Link
							to="/register"
							class="button has-text-info is-white ">
							Register
						</Link>
					</div>
				</div>
			{/if}
		</nav>
	</div>

	<div class="hero-body is-align-items-start has-text-centered">
		<div class="container">
			<slot />
		</div>
	</div>
</section>
