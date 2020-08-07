<template>
	<wrapper>
		<create-form
			:form-type="'create'"
			:form-name="'skill'"
			:form-title="'スキルを登録する'"
			:form-items="formItems"
		></create-form>
	</wrapper>
</template>

<script>
	import { mapActions } from 'vuex'
	import store from 'store/page/skillmap/form/create/skill'
	import Wrapper    from 'components/parts/common/_wrapper'
	import CreateForm from 'components/parts/skillmap/form/create/_createForm'
	export default {
		store,
		components: {
			Wrapper,
			CreateForm,
		},
		data() {
			return {
				formItems: [
					{
						name    : 'skill_large_category_id',
						required: true,
						type    : 'selectBox',
						title   : '大カテゴリを選択する',
						value   : '',
						property: {
							selectName: '大カテゴリ',
							selectData: [],
						}
					},
					{
						name    : 'skill_small_category_id',
						required: true,
						type    : 'selectBox',
						title   : '小カテゴリを選択する',
						value   : '',
						property: {
							selectName: '小カテゴリ',
							selectData: [],
						}
					},
					{
						name    : 'name',
						required: true,
						type    : 'inputText',
						title   : 'スキル名を入力する',
						value   : '',
						property: {
							placeholder: 'スキル名',
						}
					},
				],
			}
		},
		mounted() {
			this.get({
				url: '/front/skillmap/form/create/skillSmallCategory',
				success: res => {
					let formItem;
					formItem = this.formItems.find(function(item) {
						return item.name == 'skill_large_category_id';
					});
					formItem.property.selectData = res.skillLargeCategories;

					formItem = this.formItems.find(function(item) {
						return item.name == 'skill_small_category_id';
					});
					formItem.property.selectData = res.skillSmallCategories;
				}
			});
		},
		methods: {
			...mapActions('api', ['get']),
		},
	}
</script>