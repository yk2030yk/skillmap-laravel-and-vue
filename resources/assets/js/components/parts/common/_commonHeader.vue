<template>
	<div>
		<div class="header">
			<div class="header__items">
				<div
					class="header__item --openMenuButton"
					@click="isOpenMenu = !isOpenMenu"
				>
					<div
						:class="{ '--active' : isOpenMenu }"
						class="hamburgerMenu"
					></div>
				</div>
			</div>
		</div>
		<div
			:class="{ '--active' : isOpenMenu }"
			class="header__menu"
			@click="isOpenMenu = !isOpenMenu">
			<p
				class="header__menu__item --title"
				@click.stop.prevent
			>メニュー</p>
			<router-link
				v-for="(link, index) in links"
				class="header__menu__item --link"
				:class="'--indent' + link.indent"
				:to="link.path"
				:key="index"
			>■ {{ link.title }}</router-link>
		</div>
		<div
			class="header__networkErrorMessage"
			v-if="isNetworkError"
		>ネットワークエラーがありました。時間を置いてもう一度お試しください。</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex'
	import routes from 'routes'
	export default {
		data: function() {
			return {
				isOpenMenu: false,
				links: routes,
			}
		},
		props: {
			...mapState('api', ['isNetworkError']),
		}
	}
</script>