<template>
	<div class="skillmap">
		<table class="skillmap__table">
			<thead>
				<tr class="skillmap__row">
					<th class="skillmap__column --row_head --col_head --first --sticky --certification">
						<div class="skillmap__columnContent --row_head --col_head --first">大カテゴリ名</div>
					</th> 
					<th class="skillmap__column --row_head --col_head --second --sticky --certification">
						<div class="skillmap__columnContent --row_head --col_head --second">小カテゴリ名</div>
					</th>
					<th class="skillmap__column --row_head --col_head --third --sticky --certification">
						<div class="skillmap__columnContent --row_head --col_head --third">資格名</div>
					</th>
					<td
						v-for="member in filteredMembers"
						:key="member.id"
						class="skillmap__column --row_head --col_body --sticky"
						@click="setSortVertical(member.id)"
					>
						<div class="skillmap__columnContent --row_head --col_body">
							<p>
								{{ member.name }}
								<span
									v-if="selectedMemberId == member.id && sort.vertical.label"
									class="skillmap__sortArrow"
								>{{ sort.vertical.label }}</span>
							</p>
						</div>
					</td>
				</tr>
			</thead>
			<tbody> 
				<tr
					v-for="(certification, index) in filteredCertifications"
					:key="certification.id"
					class="skillmap__row"
				>
					<th
						v-if="index == 0"
						class="skillmap__column --row_body --col_head --first --sticky --certification"
						:rowspan="filteredCertifications.length"
					>
						<div class="skillmap__columnContent --row_body --col_head --first">
							<p>資格</p>
						</div>
					</th>
					<th
						v-if="certification.rowspan"
						class="skillmap__column --row_body --col_head --second --sticky --certification"
						:rowspan="certification.rowspan.count"
					>
						<div class="skillmap__columnContent --row_body --col_head --second">
							<p>{{ certification.certification_category.name }}</p>
						</div>
					</th>
					<th
						class="skillmap__column --row_body --col_head --third --sticky --certification"
						@click="setSortHorizontal(certification.id)"
					>
						<div class="skillmap__columnContent --row_body --col_head --third">
							<p>
								{{ certification.name }}
								<span
									v-if="selectedCertificationId == certification.id && sort.horizontal.label"
									class="skillmap__sortArrow"
								>{{ sort.horizontal.label }}</span>
							</p>
						</div>
					</th>
					<td
						v-for="member in filteredMembers"
						:key="member.id"
						class="skillmap__column --row_body --col_body"
						:class="[ isGet(member, certification.id) ? '--lvGet' : '--lvNotGet' ]"
					>
						<div class="skillmap__columnContent --row_body --col_body">
							{{ isGet(member, certification.id) ? '○' : '' }}
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
	import membersMixins from 'components/mixins/members'

	const sort = {
		mixins: [sortMixins],
		data: function() {
			return{
				selectedMemberId : null,
				selectedCertificationId  : null,
				sort : {
					vertical   : { id : 0, label : '' },
					horizontal : { id : 0, label : '' }
				},
				sortConfig : {
					vertical : {
						compareFunction : {
							0 : false,
							1 : (a, b) => { return this.compareVertical(a, b); },
							2 : (a, b) => { return this.compareVertical(b, a); },
						},
						label : { 0 : '', 1 : '▲', 2 : '▼' }
					},
					horizontal : {
						compareFunction : {
							0 : false,
							1 : (a, b) => { return this.compareHorizontal(a, b); },
							2 : (a, b) => { return this.compareHorizontal(b, a); },
						},
						label : { 0 : '', 1 : '◀', 2 : '▶' }
					}
				}
			};
		},
		methods: {
			sortVertical(certification) {
				const sortId = this.sort.vertical.id;
				const compareFunction
					= this.sortConfig.vertical.compareFunction[sortId];
				if (compareFunction) certification.sort(compareFunction);
			},
			sortHorizontal(members) {
				const sortId = this.sort.horizontal.id;
				const compareFunction
					= this.sortConfig.horizontal.compareFunction[sortId];
				if (compareFunction) members.sort(compareFunction);
			},
			setSortVertical(memberId) {
				const old = this.selectedMemberId;
				this.selectedMemberId = memberId;

				const config = this.sortConfig.vertical;
				const sort   = this.sort.vertical;
				let sortId = sort.id;

				if (sortId != 0 && old != memberId) return;

				if (++sortId > 2) sortId = 0;
				sort.id    = sortId;
				sort.label = config.label[sortId];
			},
			setSortHorizontal(certificationId) {
				const old = this.selectedCertificationId;
				this.selectedCertificationId = certificationId;

				const config = this.sortConfig.horizontal;
				const sort   = this.sort.horizontal;
				let sortId = sort.id;

				if (sortId != 0 && old != certificationId) return;
				
				if (++sortId > 2) sortId = 0;
				sort.id    = sortId;
				sort.label = config.label[sortId];
			},
			compareVertical(a, b) {
				let m = this.getMemberById(this.selectedMemberId);
				let isGetA = this.isGet(m, a.id);
				let isGetB = this.isGet(m, b.id);
				if (!isGetA &&  isGetB) return  1;
				if ( isGetA && !isGetB) return -1;

				let nameA = a.certification_category.name + a.name;
				let nameB = b.certification_category.name + b.name;

				return this.compareName(nameB, nameA);
			},
			compareHorizontal(a, b) {
				let id = this.selectedCertificationId;
				let isGetA = this.isGet(a, id);
				let isGetB = this.isGet(b, id);
				if (!isGetA &&  isGetB) return  1;
				if ( isGetA && !isGetB) return -1;
				return this.compareName(b.name, a.name);
			},
		}
	}

	const members = {
		mixins: [membersMixins],
		methods : {
			filterMembers(members) {
				return members.filter(member => {
					return (this.filter.annual ? member.annual == this.filter.annual : true) &&
						   (this.filter.teamId ? member.teamId == this.filter.teamId : true);
				});
			},
			isGet(member, id) {
				return member.certificationStatus.indexOf(id) > -1
			}
		},
		computed: {
			filteredMembers() {
				let members = this.members;
				members = this.filterMembers(members);
				this.sortHorizontal(members);
				return members;
			},
		},
	}

	const certifications = {
		methods: {
			filterCertification(certifications) {
				return certifications.filter(certification => {
					return this.filter.certificationCategoryId ?
							certification.certification_category.id == this.filter.certificationCategoryId : true;
				});
			},
			/* TODO: いけてないので修正したい */
			addRowspan(certifications) {
				let currrentId;
				let currrentRowspan;
				const rowspan = { count : 0 };

				certifications.map(certification => {
					this.$delete(certification, 'rowspan');
					
					if (currrentId != certification.certification_category.id) {
						currrentRowspan = Object.assign({}, rowspan);
						this.$set(certification, 'rowspan', currrentRowspan);
					}

					currrentRowspan.count++;
					currrentId = certification.certification_category.id;
				});
			},
		},
		computed: {
			filteredCertifications() {
				let certifications = this.certifications;
				certifications = this.filterCertification(certifications);
				this.sortVertical(certifications);
				this.addRowspan(certifications);
				return certifications;
			},
		},
	}

	export default {
		mixins: [
			sort,
			members,
			certifications
		],
		props: [
			'originMembers',
			'originCertifications',
		],
		computed: {
			...mapState('certificationTableFilter', ['filter']),
			members() {
				return this.originMembers.slice();
			},
			certifications() {
				return this.originCertifications.slice();
			},
		},
	}
</script>