<template>
	<wrapper>
		<create-form
			:form-type="'create'"
			:form-name="'certification'"
			:form-title="'資格カテゴリを登録する'"
			:form-items="formItems"
		></create-form>
	</wrapper>
</template>

<script>
	import { mapActions } from 'vuex'
	import store from 'store/page/skillmap/form/create/certificationCategory'
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
						name    : 'name',
						required: true,
						type    : 'inputText',
						title   : '資格カテゴリ名を入力する',
						value   : '',
						property: {
							placeholder: '資格カテゴリ名',
						}
					},
				],
			}
		},
	}
</script>