<template>
	<div class="filterBar">
		<div class="filterBar__title">
			<p>絞り込み条件</p>
			<span
				@click="toggleFilterBar"
				class="filterBar__close"
			></span>
		</div>
		<div class="filterBar__closeArea"
			:class="{ '--active' : isOpenFilterBar }">
			<div class="filterBar__item">
				<select
					v-model="filterSkillLargeCategoryId">
					<option value="" selected>未選択</option>
					<option
						v-for="category in skillLargeCategories"
						:value="category.id"
					>{{ category.name }}</option>
				</select>
			</div>
			<div class="filterBar__item --parts_kind">
				<div>
					<input type="radio" id="radio3" value="0" v-model="filterKind">
					<label for="radio3">両方</label>
				</div>
				<div>
					<input type="radio" id="radio1" value="1" v-model="filterKind">
					<label for="radio1">現在のみ</label>
				</div>
				<div>
					<input type="radio" id="radio2" value="2" v-model="filterKind">
					<label for="radio2">未来のみ</label>
				</div>
			</div>
			<div class="filterBar__item --parts_sort">
				<div>
					<input type="radio" id="sradio1" value="0" v-model="filterSort">
					<label for="sradio1">現在昇順</label>
				</div>
				<div>
					<input type="radio" id="sradio2" value="1" v-model="filterSort">
					<label for="sradio2">未来昇順</label>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState, mapActions } from 'vuex'
	export default {
		props: ['skillLargeCategories'],
		data() {
			return {
				isOpenFilterBar: true,
			}
		},
		methods: {
			...mapActions('chartFilter', [
				'setSkillLargeCategoryId',
				'setKind',
				'setSort',
			]),
			toggleFilterBar() {
				this.isOpenFilterBar = !this.isOpenFilterBar;
			},
		},
		computed: {
			...mapState('chartFilter', ['filter']),
			filterSkillLargeCategoryId: {
				get()  { return this.filter.skillLargeCategoryId },
				set(v) { this.setSkillLargeCategoryId(v) }
			},
			filterKind: {
				get()  { return this.filter.kind },
				set(v) { this.setKind(v) }
			},
			filterSort: {
				get()  { return this.filter.sort },
				set(v) { this.setSort(v) }
			}
		}
	}
</script>