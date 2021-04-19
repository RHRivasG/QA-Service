<script type="text/javascript">
	import { Router, Route } from "svelte-routing";
	import Layout from "./Layout.svelte";
	import Login from "./auth/Login.svelte";
	import QuestionList from "./components/QuestionList.svelte";
</script>

<Router>
	<Layout>
		<Route path="/">
			<QuestionList typelist={'accepted'} />
		</Route>
		<Route path="/pending">
			<QuestionList typelist={'pending'} />
		</Route>
		<Route path="/denied">
			<QuestionList typelist={'denied'} />
		</Route>

		<Route path="/login" component={Login} />
	</Layout>
</Router>
