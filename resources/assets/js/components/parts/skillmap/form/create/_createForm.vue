<template>
	<div class="form">
		<div class="form__items">
			<div class="form__item__title">{{ formTitle }}</div>
			<div class="form__item__messaages">
				<div
					v-if="isSuccess"
					class="form__item__messaage --success"
				>登録に成功しました。</div>
				<div
					v-else-if="errors.length > 0"
					class="form__item__messaage --error"
				>
					<p v-for="errorMessage in errors">・{{ errorMessage }}</p>
				</div>
			</div>
			<div class="form__item formTable">
				<div
					v-for="item in formItems"
					class="formTable__tr"
					:class="{ '--validateError' : item.isValid }"
				>
					<div class="formTable__td --left">
						<div class="formTable__label">
							<div>{{ item.title }}</div>
							<div
								v-if="item.required"
								class="formTable__label__required"
							>必須</div>
						</div>
					</div>
					<div class="formTable__td --right">
						<!-- ============================
						# <input type="text">
						============================ -->
						<input
							v-if="item.type == 'inputText'"
							type="text"
							v-model="item.value"
							class="formTable__input"
							:placeholder="item.property.placeholder"
						/>
						<!-- ============================
						# <select>
						============================ -->
						<div
							v-else-if="item.type == 'selectBox'"
							class="formTable__selectBox">
							<select v-model="item.value">
								<option disabled value="">{{ item.property.selectName }}を選択してください。</option>
								<option
									v-for="category in item.property.selectData"
									:value="category.id"
								>{{ category.name }}</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="form__item">
				<div
					@click="register"
					:class="{ '--disable' : !isValid }"
					class="form__item__submit"
				>登録する</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState, mapActions } from 'vuex'
	import API_URLS from 'config/API_URLS'
	import Validator from 'modules/Validator'
	import ValidatorMixins from 'components/mixins/Validator'

	export default {
		mixins: [
			ValidatorMixins
		],
		props: {
			formType : { type: String },
			formName : { type: String },
			formTitle: { type: String },
			formItems: { type: Array  },
		},
		data() {
			return {
				errors: [],
				isSuccess: false,
			}
		},
		methods: {
			...mapActions('api', ['post']),
			register() {
				this.resetFormStatus();
				this.post({
					url: API_URLS[this.formName].create,
					params: this.postData,
					success: (res) => {
						if (res.result_code == 0) {
							if (res.errors) res.errors.forEach(item => {
								this.errors.push(item.message) });
							this.isSuccess = false;
						} else if (res.result_code == 1) {
							this.resetFormValue();
							this.isSuccess = true;
						}
					},
				});
			},
			resetFormStatus() {
				this.errors    = [];
				this.isSuccess = false;
			},
			resetFormValue() {
				this.formItems.forEach(item => { item.value = '' });
			},
			validateForm() {
				this.formItems.forEach(item => {
					if (!item.rules) return;
					item.isValid = !this.validate(item.rules, item.value);
				});
			}
		},
		computed: {
			isValid() {
				this.validateForm();
				const isValid = this.formItems.find(item => {return item.isValid });
				return !isValid;
			},
			postData() {
				let data = {};
				this.formItems.forEach(item => {
					data[item.name] = item.value;
				});
				return data;
			}
		},
	}
</script>