<template>
	<div class="skillmap">
		<table class="skillmap__table">
			<thead>
				<tr class="skillmap__row">
					<th class="skillmap__column --row_head --col_head --first --sticky --skill">
						<div class="skillmap__columnContent --row_head --col_head --first">大カテゴリ名</div>
					</th> 
					<th class="skillmap__column --row_head --col_head --second --sticky --skill">
						<div class="skillmap__columnContent --row_head --col_head --second">小カテゴリ名</div>
					</th>
					<th class="skillmap__column --row_head --col_head --third --sticky --skill">
						<div class="skillmap__columnContent --row_head --col_head --third">スキル名</div>
					</th>
					<td
						v-for="member in filteredMembers"
						:key="member.id"
						class="skillmap__column --row_head --col_body --sticky"
						@click="updateSortStatus('vertical', member.id)"
					>
						<div class="skillmap__columnContent --row_head --col_body">
							<p>
								{{ member.name }}
								<span
									v-if="sortStatus.vertical.sortBy == member.id"
									class="skillmap__sortArrow"
								>{{ sortLabel('vertical') }}</span>
							</p>
						</div>
					</td>
				</tr>
			</thead>
			<tbody> 
				<tr
					v-for="skill in filteredSkills"
					:key="skill.id"
					class="skillmap__row"
				>
					<th
						v-if="skill.rowspanLarge"
						class="skillmap__column --row_body --col_head --first --sticky --skill"
						:rowspan="skill.rowspanLarge.count"
					>
						<div class="skillmap__columnContent --row_body --col_head --first">
							<p>{{ skill.skill_small_category.skill_large_category.name }}</p>
						</div>
					</th>
					<th
						v-if="skill.rowspanSmall"
						class="skillmap__column --row_body --col_head --second --sticky --skill"
						:rowspan="skill.rowspanSmall.count"
					>
						<div class="skillmap__columnContent --row_body --col_head --second">
							<p>{{ skill.skill_small_category.name }}</p>
						</div>
					</th>
					<th
						class="skillmap__column --row_body --col_head --third --sticky --skill"
						@click="updateSortStatus('horizontal', skill.id)"
					>
						<div class="skillmap__columnContent --row_body --col_head --third">
							<p>
								{{ skill.name }}
								<span
									v-if="sortStatus.horizontal.sortBy == skill.id"
									class="skillmap__sortArrow"
								>{{ sortLabel('horizontal') }}</span>
							</p>
						</div>
					</th>
					<td
						v-for="member in filteredMembers"
						:key="member.id"
						class="skillmap__column --row_body --col_body"
						:class="'--lv' + member.skillLevel[skill.id]"
					>
						<div class="skillmap__columnContent --row_body --col_body">
							{{ member.skillLevel[skill.id] || '-' }}
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	import { mapState, mapActions } from 'vuex'
	import sortMixins    from 'components/mixins/sort'

	const SORT_TYPE = {
		VERTICAL  : 'vertical',
		HORIZONTAL: 'horizontal',
	};

	export default {
		mixins: [
			sortMixins,
		],
		props: [
			'originMembers',
			'originSkills'
		],
		data() {
			return {
				sortStatus : {
					[SORT_TYPE.VERTICAL]: {
						sortBy   : '',
						direction: 1,
						label    : ['▲', '▼']
					},
					[SORT_TYPE.HORIZONTAL]: {
						sortBy   : '',
						direction: 1,
						label    : ['◀', '▶']
					}
				},
				rowspanSmall: [],
				rowspanLarge: [],
			};
		},
		methods: {
			addRowspan(skills) {
				let currrentSmallId;
				let currrentLargeId;
				let currrentRowspanSmall;
				let currrentRowspanLarge;
				const rowspan = { count : 0 };

				skills.map(skill => {
					this.$delete(skill, 'rowspanSmall');
					this.$delete(skill, 'rowspanLarge');
					
					if (currrentSmallId != skill.skill_small_category.id) {
						currrentRowspanSmall = Object.assign({}, rowspan);
						this.$set(skill, 'rowspanSmall', currrentRowspanSmall);
					}
					if (currrentLargeId != skill.skill_small_category.skill_large_category.id) {
						currrentRowspanLarge = Object.assign({}, rowspan);
						this.$set(skill, 'rowspanLarge', currrentRowspanLarge);
					}

					currrentRowspanSmall.count++;
					currrentRowspanLarge.count++;

					currrentSmallId = skill.skill_small_category.id;
					currrentLargeId = skill.skill_small_category.skill_large_category.id;
				});
			}
		},
		computed: {
			...mapState('skillTableFilter', ['filter']),
			members() {
				return this.originMembers.slice();
			},
			skills() {
				return this.originSkills.slice();
			},
			filteredMembers() {
				let members = this.members.filter(member => {
					return  (this.filter.annual ? member.annual == this.filter.annual : true) &&
							(this.filter.teamId ? member.teamId == this.filter.teamId : true);
				});

				const sortStatus = this.sortStatus[SORT_TYPE.HORIZONTAL];
				const skillId    = sortStatus.sortBy;
				const direction  = sortStatus.direction;

				if (skillId) {
					members.sort((a, b) => {
						const nameA = this.getSkillLevel(a, skillId) + a.name;
						const nameB = this.getSkillLevel(b, skillId) + b.name;
						return this.compareName(nameB, nameA) * direction;
					});
				}
				return members;
			},
			filteredSkills() {
				let skills = this.skills.filter(skill => {
					return (this.filter.skillSmallCategoryId ? 
							skill.skill_small_category.id == this.filter.skillSmallCategoryId : true) &&
							(this.filter.skillLargeCategoryId ?
							skill.skill_small_category.skill_large_category.id == this.filter.skillLargeCategoryId : true);
				});

				const sortStatus = this.sortStatus[SORT_TYPE.VERTICAL];
				const member     = this.members.find(member => {
					return member.id == sortStatus.sortBy
				});
				const direction  = sortStatus.direction;

				if (member) {
					skills.sort((a, b) => {
						/* レベル > 大カテゴリ > 小カテゴリ > スキル名 の順番でソートする */
						const nameA = this.getSkillLevel(member, a.id) + 
									a.skill_small_category.skill_large_category.name +
									a.skill_small_category.name + a.name;
						const nameB = this.getSkillLevel(member, b.id) +
									b.skill_small_category.skill_large_category.name + 
									b.skill_small_category.name + b.name;
						return this.compareName(nameB, nameA) * sortStatus.direction;
					});
				}

				this.addRowspan(skills);

				return skills;
			},
			getSkillLevel() {
				return (member, skillId) => {
					let lv = member.skillLevel[skillId];
					return isNaN(lv) ? -1 : lv;
				};
			},
		},
	}
</script>