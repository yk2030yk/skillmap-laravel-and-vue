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
							v-model="selectAnnual"
						>
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
							v-model="selectTeam"
						>
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
					<td>大カテゴリ</td>
					<td>
						<select
							class="narrowCond__item__select"
							v-model="selectSkillLargeCategory"
						>
							<option value="">絞り込みなし</option>
							<option
								v-for="lc in skillLargeCategories"
								:value="lc.id"
							>{{ lc.name }}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>小カテゴリ</td>
					<td>
						<select
							class="narrowCond__item__select"
							v-model="selectSkillSamllCategory"
						>
							<option value="">絞り込みなし</option>
							<option
								v-for="sc in skillSmallCategories"
								:value="sc.id"
							>{{ sc.name }}</option>
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
			'skillLargeCategories',
			'skillSmallCategories',
			'teams',
			'annuals'
		],
		methods: {
			...mapActions('skillTableFilter', [
				'setAnnual',
				'setTeamId',
				'setSkillLargeCategoryId',
				'setSkillSmallCategoryId'
			]),
		},
		computed: {
			...mapState('skillTableFilter', ['filter']),
			selectAnnual: {
				get()  { return this.filter.annual },
				set(v) { this.setAnnual(v) }
			},
			selectTeam: {
				get()  { return this.filter.teamId },
				set(v) { this.setTeamId(v) }
			},
			selectSkillLargeCategory: {
				get()  { return this.filter.skillLargeCategoryId },
				set(v) { this.setSkillLargeCategoryId(v) }
			},
			selectSkillSamllCategory: {
				get()  { return this.filter.skillSmallCategoryId },
				set(v) { this.setSkillSmallCategoryId(v) }
			}
		}
	}
</script>