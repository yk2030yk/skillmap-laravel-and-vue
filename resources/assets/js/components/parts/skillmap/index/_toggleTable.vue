<template>
	<div class="toggleTable">
		<div>テーブルの切り替え</div>
		<div class="toggleTable__names">
			<div
				class="toggleTable__name"
				:class="{ '--active': isShowTable.skill }"
				@click="changeShowStatus(true, false)"
			>スキル</div>
			<div
				class="toggleTable__name"
				:class="{ '--active': isShowTable.certification }"
				@click="changeShowStatus(false, true)"
			>資格</div>
		</div>
	</div>
</template>

<script>
	import { mapState, mapActions } from 'vuex'
	export default {
		methods: {
			...mapActions('toggle', [
				'setSkill',
				'setCertification'
			]),
			changeShowStatus(s, c) {
				this.setSkill(s);
				this.setCertification(c);
			}
		},
		computed: {
			...mapState('toggle', ['isShowTable']),
		},
	}
</script>