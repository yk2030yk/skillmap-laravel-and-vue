<template>
	<wrapper>
		<div class="contentHead">
			<div class="contentHead__item --left">
				<toggle-table></toggle-table>
			</div>
			<div class="contentHead__item --right">
				<skill-table-filter
					v-if="isShowTable.skill"
					:skill-large-categories="skillLargeCategories"
					:skill-small-categories="skillSmallCategories"
					:teams="teams"
					:annuals="annuals"
				></skill-table-filter>
				<certification-table-filter
					v-if="isShowTable.certification"
					:certification-categories="certificationCategories"
					:teams="teams"
					:annuals="annuals"
				></certification-table-filter>
			</div>
		</div>
		<div class="contentMain">
			<skill-table
				v-if="isShowTable.skill"
				:origin-members="members"
				:origin-skills="skills"
			></skill-table>
			<certification-table
				v-if="isShowTable.certification"
				:origin-members="members"
				:origin-certifications="certifications"
			></certification-table>
		</div>
	</wrapper>
</template>

<script>
	import { mapActions, mapState } from 'vuex'
	import store from 'store/page/skillmap/index'
	import Wrapper                  from 'components/parts/common/_wrapper'
	import skillTableFilter         from 'components/parts/skillmap/index/_skillTableFilter'
	import skillTable               from 'components/parts/skillmap/index/_skillTable'
	import certificationTableFilter from 'components/parts/skillmap/index/_certificationTableFilter'
	import certificationTable       from 'components/parts/skillmap/index/_certificationTable'
	import toggleTable              from 'components/parts/skillmap/index/_toggleTable'

	export default {
		store,
		components: {
			Wrapper,
			skillTableFilter,
			skillTable,
			certificationTableFilter,
			certificationTable,
			toggleTable,
		},
		data() {
			return {
				members                : [],
				skills                 : [],
				certifications         : [],
				skillLargeCategories   : [],
				skillSmallCategories   : [],
				certificationCategories: [],
				teams                  : [],
				annuals                : [],
			}
		},
		mounted() {
			this.get({
				url: '/front/skillmap',
				success: (res) => {
					this.members                 = res.members;
					this.skills                  = res.skills;
					this.certifications          = res.certifications;
					this.skillLargeCategories    = res.skillLargeCategories;
					this.skillSmallCategories    = res.skillSmallCategories;
					this.certificationCategories = res.certificationCategories;
					this.teams                   = res.teams;
					this.annuals                 = res.annuals;
				}
			});
		},
		methods: {
			...mapActions('api', ['get']),
		},
		computed: {
			...mapState('toggle', ['isShowTable']),
		}
	}
</script>