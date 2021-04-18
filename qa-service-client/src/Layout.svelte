<script>
	import { Link, navigate } from "svelte-routing";
	import { user } from "./stores/auth.js";

	function logout() {
		fetch("http://localhost:8000/api/logout", {
			method: "post",
			headers: {
				Authorization: "Bearer " + $user.access_token,
			},
		}).then(async (res) => console.log(await res.json()));
		user.logoutUser();
		navigate("/");
		localStorage.clear();
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
</style>

<section class="hero is-info is-fullwidth is-fullheight">
	<div class="hero-head">
		<nav
			class="navbar is-spaced"
			role="navigation"
			aria-label="main navigation">
			<div class="navbar-brand">
				<h2 class="title">Q&A Service</h2>

				<a
					href="/"
					role="button"
					class="navbar-burger"
					aria-label="menu"
					aria-expanded="false"
					data-target="navbarBasicExample">
					<span aria-hidden="true" />
					<span aria-hidden="true" />
					<span aria-hidden="true" />
				</a>
			</div>

			{#if $user && $user.roles.includes('moderator')}
				<div id="navbarBasicExample" class="navbar-menu mb-3">
					<div class="navbar-start">
						<Link to="/" class="navbar-item">Accepted</Link>
						<Link to="/pending" class="navbar-item">Pending</Link>
						<Link to="/denied" class="navbar-item">Denied</Link>
					</div>
				</div>
			{/if}

			{#if $user}
				<div class="navbar-end">
					<div
						class="navbar-item has-dropdown is-hoverable has-background-info">
						<button href="/" class=" button is-white has-text-info">
							{$user.username}
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
					<Link to="/login" class="button has-text-info is-white ">
						Login
					</Link>
				</div>
			{/if}
		</nav>
	</div>

	<div class="hero-body">
		<div class="container has-text-centered">
			<slot />
		</div>
	</div>
</section>
