<template>
	<div
		v-if="isLoading"
		class="loading">
		<div class="loading__imageBox">
			<img
				class="loading__imageBox__img"
				src="/img/loader.gif" />
		</div>
		<div class="loading__text">
			<p>Now Loading...</p>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex'

	export default {
		computed: {
			...mapState('api', ['isLoading'])
		},
	}
</script>