<template>
	<div class="narrowCond">
		<div class="narrowCond__item">
			<table>
				<tr>
					<th colspan="2">列絞り込み</th>
				</tr>
				<tr>
					<td>年次</td>
					<td>
						<select
							class="narrowCond__item__select"
							v-model="selectedAnnual">
							<option value="">絞り込みなし</option>
							<option
								v-for="annual in annuals"
								:value="annual"
							>{{ annual }}年度</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>チーム</td>
					<td>
						<select
							class="narrowCond__item__select"
							v-model="selectedTeamId">
							<option value="">絞り込みなし</option>
							<option
								v-for="t in teams"
								:value="t.id"
							>{{ t.name }}</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div class="narrowCond__item">
			<table>
				<tr>
					<th colspan="2">行絞り込み</th>
				</tr>
				<tr>
					<td>資格カテゴリ</td>
					<td>
						<select
							class="narrowCond__item__select"
							v-model="selectedCertificationCategoryId">
							<option value="">絞り込みなし</option>
							<option
								v-for="cc in certificationCategories"
								:value="cc.id"
							>{{ cc.name }}</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
</template>

<script>
	import { mapState, mapActions } from 'vuex'
	export default {
		props: [
			'certificationCategories',
			'teams',
			'annuals'
		],
		methods: {
			...mapActions('certificationTableFilter', [
				'setAnnual',
				'setTeamId',
				'setCertificationCategoryId'
			]),
		},
		computed: {
			...mapState('certificationTableFilter', ['filter']),
			selectedAnnual: {
				get()  { return this.filter.annual },
				set(v) { this.setAnnual(v) }
			},
			selectedTeamId: {
				get()  { return this.filter.teamId },
				set(v) { this.setTeamId(v) }
			},
			selectedCertificationCategoryId: {
				get()  { return this.filter.certificationCategoryId },
				set(v) { this.setCertificationCategoryId(v) }
			},
		}
	}
</script>