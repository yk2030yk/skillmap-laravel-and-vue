<template>
	<wrapper>
		<create-form
			:form-type="'create'"
			:form-name="'certification'"
			:form-title="'スキル小カテゴリを登録する'"
			:form-items="formItems"
		></create-form>
	</wrapper>
</template>

<script>
	import { mapActions } from 'vuex'
	import store from 'store/page/skillmap/form/create/member'
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
						name    : 'name',
						required: true,
						type    : 'inputText',
						title   : '小カテゴリ名を入力する',
						value   : '',
						property: {
							placeholder: '小カテゴリ',
						}
					},
				],
			}
		},
	}
</script>