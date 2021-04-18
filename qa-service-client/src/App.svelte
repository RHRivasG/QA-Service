<script type="text/javascript">
	import { Router, Route } from "svelte-routing";
	import PendingList from "./pages/PendingList.svelte";
	import DeniedList from "./pages/DeniedList.svelte";
	import Layout from "./Layout.svelte";
	import { user } from "./stores/auth.js";
	import Login from "./auth/Login.svelte";
	import QuestionList from "./pages/QuestionList.svelte";
</script>

<Router>
	<Layout>
		<Route path="/" component={QuestionList} />
		<Route path="/pending" component={PendingList} />
		<Route path="/denied" component={DeniedList} />
		<Route path="/login" component={Login} />
	</Layout>
</Router>
