export default {
	methods: {
		compareName(a, b) {
			a = a.toUpperCase();
			b = b.toUpperCase();
			if (a > b) return  1;
			if (a < b) return -1;
			return 0;
		},
		updateSortStatus(sortType, sortBy) {
			let sortStatus = this.sortStatus[sortType];
			sortStatus.direction = sortStatus.direction * -1;
			sortStatus.sortBy    = sortBy;
		},
	},
	computed: {
		sortLabel(sortType) {
			return sortType => {
				let sortStatus = this.sortStatus[sortType];
				return sortStatus.direction > 0 ? sortStatus.label[0] : sortStatus.label[1];
			}
		}
	}
}