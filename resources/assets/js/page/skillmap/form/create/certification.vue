<template>
	<wrapper>
		<create-form
			:form-type="'create'"
			:form-name="'certification'"
			:form-title="'資格を登録する'"
			:form-items="formItems"
		></create-form>
	</wrapper>
</template>

<script>
	import { mapActions } from 'vuex'
	import store from 'store/page/skillmap/form/create/certification'
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
						name    : 'certification_category_id',
						required: true,
						type    : 'selectBox',
						title   : '資格カテゴリを選択する',
						value   : '',
						property: {
							selectName: '資格カテゴリ',
							selectData: [],
						}
					},
					{
						name    : 'name',
						required: true,
						type    : 'inputText',
						title   : '資格名を入力する',
						value   : '',
						property: {
							placeholder: '資格名',
						}
					},
				],
			}
		},
		mounted() {
			this.get({
				url: '/front/skillmap/form/create/certification',
				success: res => {
					let formItem = this.formItems.find(function(item) {
						return item.name == 'certification_category_id';
					});
					formItem.property.selectData = res.certificationCategories;
				}
			});
		},
		methods: {
			...mapActions('api', ['get']),
		},
	}
</script>