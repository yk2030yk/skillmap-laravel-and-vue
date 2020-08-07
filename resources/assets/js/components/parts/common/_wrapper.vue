<template>
	<div>
		<loading></loading>
		<common-header></common-header>
		<div class="content">
			<slot></slot>
		</div>
		<common-footer></common-footer>
	</div>
</template>

<script>
	import CommonHeader from 'components/parts/common/_commonHeader'
	import CommonFooter from 'components/parts/common/_commonFooter'
	import Loading      from 'components/parts/common/_loading'
	export default {
		components: {
			CommonHeader,
			CommonFooter,
			Loading,
		},
	}
</script>