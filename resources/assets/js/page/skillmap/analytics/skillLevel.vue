<template>
	<wrapper>
		<chart-filter
			:skill-large-categories="skillLargeCategories"
		></chart-filter>
		<div class="contentMain">
			<div class="contentChart">
				<chart
					:data="data.skillLargeCategory"
					:name="'skill_large_category'"
					:title="'スキルレベル平均(大カテゴリ別)'"
					:is-filter="0"
					:width="700"
					:height="500"
				></chart>
			</div>
			<div class="contentChart">
				<chart
					:data="data.skillSmallCategory"
					:name="'skill_small_category'"
					:title="'スキルレベル平均(小カテゴリ別)'"
					:is-filter="1"
					:width="700"
					:height="500"
				></chart>
			</div>
			<div class="contentChart">
				<chart
					:data="data.skill"
					:name="'skill'"
					:title="'スキルレベル平均(スキル別)'"
					:is-filter="1"
					:width="1000"
					:height="500"
				></chart>
			</div>
		</div>
	</wrapper>
</template>

<script>
	import { mapActions } from 'vuex'
	import store from 'store/page/skillmap/analytics/skillLevel'
	import Wrapper     from 'components/parts/common/_wrapper'
	import ChartFilter from 'components/parts/skillmap/analytics/skillLevel/_chartFilter'
	import Chart       from 'components/parts/skillmap/analytics/skillLevel/_chart'
	export default {
		store,
		components: {
			Wrapper,
			ChartFilter,
			Chart,
		},
		data: function() {
			return {
				data: {
					skillLargeCategory: [],
					skillSmallCategory: [],
					skill             : [],
				},
				skillSmallCategories: [],
				skillLargeCategories: [],
			}
		},
		mounted: function() {
			this.get({
				url: '/front/skillmap/analytics/skillLevel',
				success: (res) => {
					this.data = {
						skillLargeCategory: res.data.skillLargeCategory,
						skillSmallCategory: res.data.skillSmallCategory,
						skill             : res.data.skill,
					};
					this.skillLargeCategories = res.skillLargeCategories;
					this.skillSmallCategories = res.skillSmallCategories;
				}
			});
		},
		methods: {
			...mapActions('api', ['get']),
		},
	}
</script>