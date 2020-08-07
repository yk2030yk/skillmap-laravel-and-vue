<template>
	<wrapper>
		<create-form
			:form-type="'create'"
			:form-name="'skillSmallCategory'"
			:form-title="'スキル小カテゴリを登録する'"
			:form-items="formItems"
		></create-form>
	</wrapper>
</template>

<script>
	import { mapActions } from 'vuex'
	import store from 'store/page/skillmap/form/create/skillSmallCategory'
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
						key     : 'skill_large_category_id',
						rules   : ['number'],
						isValid : false,
						property: {
							selectName: '大カテゴリ',
							selectData: [],
							selectLabel: '',
						}
					},
					{
						name    : 'name',
						required: true,
						type    : 'inputText',
						title   : '小カテゴリ名を入力する',
						value   : '',
						key     : 'name',
						rules   : ['maxLength:n=100'],
						isValid : false,
						property: {
							placeholder: '小カテゴリ名',
						}
					},
				],
			}
		},
		mounted() {
			this.get({
				url: '/front/skillmap/form/create/skillSmallCategory',
				success: res => {
					let formItem = this.formItems.find(function(item) {
						return item.name == 'skill_large_category_id';
					});
					formItem.property.selectData = res.skillLargeCategories;
				}
			});
		},
		methods: {
			...mapActions('api', ['get']),
		},
	}
</script>