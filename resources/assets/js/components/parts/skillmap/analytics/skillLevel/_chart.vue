<script>
import { Bar, mixins as chartjsMixins } from 'vue-chartjs'
import { mapState } from 'vuex'

export default {
	extends: Bar,
	data() {
		return {
			options: {
				responsive: true,
				maintainAspectRatio: false,
				layout: {
					padding: 40,
				},
				title: {
					display: true,
					text: this.title,
				},
				scales: {
					xAxes: [{
						ticks: {
							autoSkip    : false,
							maxRotation : 90,
							minRotation : 90,
						}
					}],
				},
			},
		};
	},
	props: {
		'data'    : Array,
		'name'    : String,
		'title'   : String,
		'isFilter': Boolean,
	},
	mounted() {
		this.updateData();
		this.renderChart(this.chartData, this.options)
	},
	watch: {
		filteredData : 'updateData',
		'filter.kind': 'updateData',
	},
	methods: {
		updateData() {
			let data = this.filteredData;
			this.chartData = {
				'labels': data.map(item => { return item[this.name + '_name'] }),
				'datasets': []
			};
			
			if (this.filter.kind == 0 || this.filter.kind == 1)
				this.chartData.datasets.push({
					'label'          : '現在',
					'maxBarThickness': 100,
					'borderColor'    : "rgba(160,160,250,1)",
					'borderWidth'    : 1,
					'backgroundColor': "rgba(160,160,250,0.6)",
					'data'           : data.map(item => { return item['average_current'] }),
				});

			if (this.filter.kind == 0 || this.filter.kind == 2)
				this.chartData.datasets.push({
					'label'          : '未来',
					'maxBarThickness': 100,
					'borderColor'    : "rgba(250,160,160,1)",
					'borderWidth'    : 1,
					'backgroundColor': "rgba(250,160,160,0.6)",
					'data'           : data.map(item => { return item['average_feature'] }),
				});
		},
	},
	computed: {
		...mapState('chartFilter', ['filter']),
		filteredData() {
			let data = this.data;
			if (this.filter.skillLargeCategoryId)
				data = this.data.filter(item => {
					return item.skill_large_category_id == this.filter.skillLargeCategoryId;
				});

			if (this.filter.sort)
				data.sort((a, b) => {
					if (this.filter.sort == 0) {
						return a.average_current - b.average_current
					} else if (this.filter.sort == 1) {
						return a.average_feature - b.average_feature
					}
					return 0;
				});

			return data;
		},
	},
	mixins: [
		chartjsMixins.reactiveData
	],
}
</script>