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

			<div id="navbarBasicExample" class="navbar-menu mb-3">
				<div class="navbar-start">
					<a href="/" class="navbar-item">Accepted</a>
					<a href="/pending" class="navbar-item">Pending</a>
					<a href="denied" class="navbar-item">Denied</a>
				</div>
			</div>

			<div class="navbar-end">
				<div
					class="navbar-item has-dropdown is-hoverable has-background-info">
					<button 
						href="/"
						class="navbar-link button is-white has-text-info">
						JhonnyBravo35
					</button>

					<div class="navbar-dropdown is-right">
						<a href="/" class="navbar-item has-text-info">
							Logout
						</a>
					</div>
				</div>
			</div>
		</nav>
	</div>

	<div class="hero-body">
		<div class="container has-text-centered">
			<slot />
		</div>
	</div>
</section>
